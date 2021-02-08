<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        $merek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:MerkMotor}');
        $transmisi = $this->sparql->query('SELECT * WHERE {?transmisi rdf:type motor:Transmisi}');
        $typemotor = $this->sparql->query('SELECT * WHERE {?typemotor rdf:type motor:JenisMotor}');
        $tahun = $this->sparql->query('SELECT * WHERE {?tahun rdf:type motor:TahunProduksi}');
        $volume = $this->sparql->query('SELECT * WHERE {?volume rdf:type motor:VolumeSilinder}');
        
        $resultMerek = [];
        $resultTransmisi = [];
        $resultType = [];
        $resultTahun = [];
        $resultVolume = [];
        
        foreach($merek as $item){
            array_push($resultMerek, [
                'hasilMerek' => $this->parseData($item->merek->getUri())
            ]);
        }
        foreach($transmisi as $item){
            array_push($resultTransmisi, [
                'hasilTransmisi' => $this->parseData($item->transmisi->getUri())
            ]);
        }
        foreach($typemotor as $item){
            array_push($resultType, [
                'hasilType' => $this->parseData($item->typemotor->getUri())
            ]);
        }
        foreach($tahun as $item){
            array_push($resultTahun, [
                'hasilTahun' => $this->parseData($item->tahun->getUri())
            ]);
        }
        foreach($volume as $item){
            array_push($resultVolume, [
                'hasilVolume' => $this->parseData($item->volume->getUri())
            ]);
        }

        $data = [
            'getMerek'      => $resultMerek,
            'getTransmisi'  => $resultTransmisi,
            'getType'       => $resultType,
            'getTahun'      => $resultTahun,
            'getVolume'     => $resultVolume
        ];

        return view ('rekomendasi/index', $data);
    }

    public function getSAW(Request $request)
    {
        $sql = "SELECT * WHERE {?motor rdf:type motor:NamaUnit";

        if($request->merek != 'semua'){
            $sql = $sql." .?motor motor:AdalahMerkDari motor:".$request->merek;
        }
        if($request->transmisi != 'semua'){
            $sql = $sql." .?motor motor:AdalahJenisTransmisi motor:".$request->transmisi;
        }
        if($request->typemotor != 'semua'){
            $sql = $sql." .?motor motor:MemilikiJenis motor:".$request->typemotor;
        }
        if($request->tahun != 'semua'){
            $sql = $sql." .?motor motor:MemilikiTahunProduksi motor:".$request->tahun;
        }
        if($request->volume != 'semua'){
            $sql = $sql." .?motor motor:MemilikiVolumeSilinder motor:".$request->volume;
        }
        
        $sql = $sql.". ?motor motor:MemilikiHarga ?harga. ?motor motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. ?motor motor:MemilikiKecepatan ?kecepatan. ?motor motor:MemilikiKapasitasBahanBakar ?kapasitas. ?motor motor:MemilikiNama ?nama}";

        $resultMotor = [];
        
        $query = $this->sparql->query($sql);

        foreach($query as $item){
            array_push($resultMotor, [
                0 => $this->parseData($item->nama->getValue()),
                1 => intval($this->parseData($item->harga->getValue())),
                2 => floatval($this->parseData($item->kapasitas->getValue())),
                3 => floatval($this->parseData($item->kecepatan->getValue())),
                4 => floatval($this->parseData($item->tingkatbbm->getValue()))
            ]);
        }

        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:MemilikiBobot ?bobot. ?kriteria motor:AdalahJenisKriteria ?jenis}");
        
        $bobotKriteria = [];
        foreach($query as $item){
            array_push($bobotKriteria, [
                'kriteria'  => $this->parseData($item->kriteria->getUri()),
                'jenis'     => $this->parseData($item->jenis->getUri()),
                'bobot'     => floatval($this->parseData($item->bobot->getValue()))
            ]);
        }

        $jumlah = count($resultMotor);
        
        $normalisasi = $this->getNormalisasi($resultMotor, $jumlah);

        $rankingData = $this->getRanking($normalisasi);

        $hasilSAW = $this->getResultSAW($rankingData);

        $data = [
            'motor'         => $resultMotor,
            'normalisasi'   => $normalisasi,
            'ranking'       => $rankingData,
            'hasilSAW'      => $hasilSAW,
            'bobot'         => $bobotKriteria
        ];

        return view('rekomendasi/hasil', $data);
    }

    public function getNormalisasi ($data, $jumlahMotor)
    {
        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:AdalahJenisKriteria ?jenis}");
        $kriteriaResult = [];
        foreach($query as $item){
            array_push($kriteriaResult, [
                'kriteria'  => $this->parseData($item->kriteria->getUri()),
                'jenis'     => $this->parseData($item->jenis->getUri())
            ]);
        }
        $jumlahKriteria = count($kriteriaResult);

        //inisilalisasi nilai maxmin
        $MaxMin = [];
        foreach($kriteriaResult as $item){
            if($item['jenis'] == 'Cost'){
                array_push($MaxMin, 99999999);
            } else {
                array_push($MaxMin, 0);
            }
        }
        //memberi nilai minimal dan maksimal dari kriteria
        for($x = 0; $x < $jumlahKriteria; $x++){
            if($kriteriaResult[$x]['jenis'] == 'Cost'){
                for($i = 0; $i < $jumlahMotor; $i++){
                    for($j = 0; $j < $jumlahMotor; $j++){
                        if($data[$j][$x+1] < $MaxMin[$x]){
                            $MaxMin[$x] = $data[$i][$x+1];
                        }   
                    }
                }
            }
            else {
                for($j = 0; $j < $jumlahMotor; $j++){
                    if($data[$j][$x+1] > $MaxMin[$x]){
                        $MaxMin[$x] = $data[$j][$x+1];
                    }   
                }
            }
        }
        
        //perhitungan rating normalisasi
        $ratingNormalisasi = array();

        for($i = 0; $i < $jumlahKriteria; $i++){
            for($j = 0; $j < $jumlahMotor; $j++){
                if($kriteriaResult[$i]['jenis'] == 'Cost'){
                    $ratingNormalisasi[$j][$i] = $MaxMin[$i] / $data[$j][$i+1];
                }
                else {
                    $ratingNormalisasi[$j][$i] = $data[$j][$i+1] / $MaxMin[$i];
                }
            }
        }

        //menambahkan nama motor pada array ratingNormalisasi
        for($x = 0; $x < $jumlahMotor; $x++){
            $ratingNormalisasi[$x][$jumlahKriteria] = $data[$x][0];
        }
        return $ratingNormalisasi;
    }

    public function getRanking($data)
    {
        $jumlahMotor = count($data);

        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:MemilikiBobot ?bobot}");
        
        $bobotKriteria = [];
        foreach($query as $item){
            array_push($bobotKriteria, [
                'kriteria'  => $this->parseData($item->kriteria->getUri()),
                'bobot'     => floatval($this->parseData($item->bobot->getValue()))
            ]);
        }
        $jumlahKriteria = count($bobotKriteria);

        $hasilRekomendasi = [];
        for($i = 0; $i < $jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++){
                $hasilRekomendasi[$i][$j] = $data[$i][$j] * $bobotKriteria[$j]['bobot'];
            }
        }
        for($x = 0; $x < $jumlahMotor; $x++){
            $hasilRekomendasi[$x][$jumlahKriteria] = $data[$x][4];
        }
        return $hasilRekomendasi;
    }

    public function getResultSAW($data)
    {
        $jumlahMotor = count($data);

        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria}");

        $kriteria = [];
        foreach($query as $item){
            array_push($kriteria, $this->parseData($item->kriteria->getUri()));
        }
        $jumlahKriteria = count($kriteria);

        $hasilSAW = [];
        for($i = 0; $i <$jumlahMotor; $i++){
            $tempHasil = 0;
            for($j = 0; $j < $jumlahKriteria; $j++){
                $tempHasil = $tempHasil + $data[$i][$j];
            }
            array_push($hasilSAW, [
                'nama'  => $data[$i][4],
                'nilai' => $tempHasil
            ]);
        }
        for($j = 0; $j < $jumlahMotor; $j++){
            for($i = 0; $i <$jumlahMotor; $i++){
                if(($i+1) < ($jumlahMotor)){
                    if($hasilSAW[$i]['nilai'] < $hasilSAW[$i+1]['nilai']){
                        $tempNilai = $hasilSAW[$i]['nilai'];
                        $hasilSAW[$i]['nilai'] = $hasilSAW[$i+1]['nilai'];
                        $hasilSAW[$i+1]['nilai'] = $tempNilai;
                        $tempNama = $hasilSAW[$i]['nama'];
                        $hasilSAW[$i]['nama'] = $hasilSAW[$i+1]['nama'];
                        $hasilSAW[$i+1]['nama'] = $tempNama;
                    }
                }
            }
        }
        
        return $hasilSAW;
    }
}
