<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        //query untuk mengambil data dari fuseki untuk select option
        $merek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:Merek}');
        $transmisi = $this->sparql->query('SELECT * WHERE {?transmisi rdf:type motor:Transmisi}');
        $typemotor = $this->sparql->query('SELECT * WHERE {?typemotor rdf:type motor:Type}');
        $tahun = $this->sparql->query('SELECT * WHERE {?tahun rdf:type motor:TahunProduksi}');
        $volume = $this->sparql->query('SELECT * WHERE {?volume rdf:type motor:VolumeSilinder}');
        
        $resultMerek = [];
        $resultTransmisi = [];
        $resultType = [];
        $resultTahun = [];
        $resultVolume = [];
        
        //mengambl data dari fuseki server
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

        $dataMotor = $this->sparql->query("SELECT * WHERE {?motor rdf:type motor:Motor. ?motor motor:MemilikiNama ?nama}");
        $resultMotor = [];
        foreach($dataMotor as $item){
            array_push($resultMotor, [
                'id'    => $this->parseData($item->motor->getUri()),
                'nama'  => $this->parseData($item->nama->getValue())
            ]);
        }
        //menyimpan nilai pada satu variabel data
        $data = [
            'getMerek'      => $resultMerek,
            'getTransmisi'  => $resultTransmisi,
            'getType'       => $resultType,
            'getTahun'      => $resultTahun,
            'getVolume'     => $resultVolume,
            'getMotor'      => $resultMotor
        ];

        return view ('rekomendasi/index', $data);
    }

    public function getSAW(Request $request)
    {
        if($request->has('cari_filter')){
            //query untuk mengambil data sepeda motor dari fuseki server berdasarkan kriteria yang dipilih
            $sql = "SELECT * WHERE {?motor rdf:type motor:Motor";

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

            //menyimpan data sepeda motor pada variabel $resultMotor
            foreach($query as $item){
                array_push($resultMotor, [
                    'nama'          => $this->parseData($item->nama->getValue()),
                    'Harga'         => intval($this->parseData($item->harga->getValue())),
                    'KapasitasBBM'  => floatval($this->parseData($item->kapasitas->getValue())),
                    'Kecepatan'     => floatval($this->parseData($item->kecepatan->getValue())),
                    'KonsumsiBBM'   => floatval($this->parseData($item->tingkatbbm->getValue()))
                ]);
            }
        } else {
            $resultMotor = [];
            $jumlahMotor = count($request->motor);
            //mengambil data motor dari request dan menyimpan ke sebuah array
            for($x = 0; $x < $jumlahMotor; $x++){
                $query = $this->sparql->query('SELECT * WHERE {motor:'.$request->motor[$x].' rdf:type motor:Motor. motor:'.$request->motor[$x].' motor:MemilikiHarga ?harga. motor:'.$request->motor[$x].' motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. motor:'.$request->motor[$x].' motor:MemilikiKecepatan ?kecepatan. motor:'.$request->motor[$x].' motor:MemilikiKapasitasBahanBakar ?kapasitas. motor:'.$request->motor[$x].' motor:MemilikiNama ?nama}');
                foreach($query as $item){
                    array_push($resultMotor, [
                        'nama'          => $this->parseData($item->nama->getValue()),
                        'Harga'         => intval($this->parseData($item->harga->getValue())),
                        'KapasitasBBM'  => floatval($this->parseData($item->kapasitas->getValue())),
                        'Kecepatan'     => floatval($this->parseData($item->kecepatan->getValue())),
                        'KonsumsiBBM'   => floatval($this->parseData($item->tingkatbbm->getValue()))
                    ]);
                }
            }
        }
        
        $jumlah = count($resultMotor);

        //query untuk mengambil data kriteria dari fuseki server
        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:MemilikiBobot ?bobot. ?kriteria motor:AdalahJenisKriteria ?jenis}");
        
        //menyimpan data kriteria pada variabel $getKriteria
        $getKriteria = [];
        $kode = 1;
        foreach($query as $item){
            array_push($getKriteria, [
                'kriteria'  => $this->parseData($item->kriteria->getUri()),
                'jenis'     => $this->parseData($item->jenis->getUri()),
                'bobot'     => floatval($this->parseData($item->bobot->getValue())),
                'kode'      => "C".$kode
            ]);
            $kode += 1;
        }

        //memanggil fungsi getCrips untuk memberi nilai pada table Data Crips
        $cripsData = $this->getCrips($getKriteria);

        //memanggil fungsi getNilaiLaternatif untuk memberi nilai pada tabel Data Nilai Alternatif
        $nilaiAlternatif = $this->getNilaiAlternatif($getKriteria, $resultMotor, $cripsData);
        
        //memanggil fungsi getNormalisasi untuk memberi nilai pada tabel Hasil Normalisasi
        $normalisasi = $this->getNormalisasi($getKriteria, $nilaiAlternatif, $jumlah);

        //memanggil fungsi getRanking untuk memberi nilai pada tabel Nilai Pembobotan
        $rankingData = $this->getRanking($normalisasi);

        //memanggil fungsi getResultSAW untuk memberi nilai pada tabel Hasil Simple Additive Weighting
        $hasilSAW = $this->getResultSAW($rankingData);

        //menyimpan semua variabel pada variabel $data
        $data = [
            'motor'         => $resultMotor,
            'normalisasi'   => $normalisasi,
            'ranking'       => $rankingData,
            'hasilSAW'      => $hasilSAW,
            'bobot'         => $getKriteria,
            'crips'         => $cripsData,
            'alternatif'    => $nilaiAlternatif,
            'jumlah'        => $jumlah
        ];
        
        return view('rekomendasi/hasil', $data);
    }

    public function getCrips($kriteria)
    {
        //query untuk mengambil data seluruh sepeda motor
        $query = $this->sparql->query("SELECT * WHERE {?motor rdf:type motor:Motor. ?motor motor:MemilikiHarga ?harga. ?motor motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. ?motor motor:MemilikiKecepatan ?kecepatan. ?motor motor:MemilikiKapasitasBahanBakar ?kapasitas}");
        $motor = [];
        //meyimpan data sepeda motor pada variabel $motor
        foreach($query as $item){
            array_push($motor, [
                'motor'         => $this->parseData($item->motor->getUri()),
                'Harga'         => intval($this->parseData($item->harga->getValue())),
                'KapasitasBBM'  => floatval($this->parseData($item->kapasitas->getValue())),
                'Kecepatan'     => floatval($this->parseData($item->kecepatan->getValue())),
                'KonsumsiBBM'   => floatval($this->parseData($item->tingkatbbm->getValue()))
            ]);
        }

        //menghitung jumlah motor dan kriteria
        $jumlahKriteria = count($kriteria);
        $jumlahMotor = count($motor);

        //inisialisasi variabel array $crips
        $crips = [];
        //cek maxmin harga harga dan mencari nilai crips harga
        $arrayHarga = [];
        for($x = 0; $x < $jumlahMotor; $x++){
            $arrayHarga[$x] = $motor[$x]['Harga'];
        }
        $maxHarga = max($arrayHarga);
        $minHarga = min($arrayHarga);
        $rasio = ($maxHarga - $minHarga)/4;

        $tempHarga = $minHarga;
        for($x = 0; $x < 4; $x++){
            $crips['Harga'][$x] = $tempHarga + $rasio;
            $tempHarga = $crips["Harga"][$x];
        }

        //cek maxmin kapasitas dan mencari nilai crips kapasitas
        $arrayKapasitas = [];
        for($x = 0; $x < $jumlahMotor; $x++){
            $arrayKapasitas[$x] = $motor[$x]['KapasitasBBM'];
        }
        $maxKapasitas = max($arrayKapasitas);
        $minKapasitas = min($arrayKapasitas);
        $rasio = ($maxKapasitas - $minKapasitas)/4;

        $tempKapasitas = $minKapasitas;
        for($x = 0; $x < 4; $x++){
            $crips['KapasitasBBM'][$x] = $tempKapasitas + $rasio;
            $tempKapasitas = $crips['KapasitasBBM'][$x];
        }

        //cek maxmin kecepatan dan mencari nilai crips kecepatan
        $arrayKecepatan = [];
        for($x = 0; $x < $jumlahMotor; $x++){
            $arrayKecepatan[$x] = $motor[$x]['Kecepatan'];
        }
        $maxKecepatan = max($arrayKecepatan);
        $minKecepatan = min($arrayKecepatan);
        $rasio = ($maxKecepatan - $minKecepatan)/4;

        $tempKecepatan = $minKecepatan;
        for($x = 0; $x < 4; $x++){
            $crips['Kecepatan'][$x] = $tempKecepatan + $rasio;
            $tempKecepatan = $crips['Kecepatan'][$x];
        }

        //cek maxmin konsumsi dan mencari nilai crips konsumsi
        $arrayKonsumsi = [];
        for($x = 0; $x < $jumlahMotor; $x++){
            $arrayKonsumsi[$x] = $motor[$x]['KonsumsiBBM'];
        }
        $maxKonsumsi = max($arrayKonsumsi);
        $minKonsumsi = min($arrayKonsumsi);
        $rasio = ($maxKonsumsi - $minKonsumsi)/4;

        $tempKonsumsi = $minKonsumsi;
        for($x = 0; $x < 4; $x++){
            $crips['KonsumsiBBM'][$x] = $tempKonsumsi + $rasio;
            $tempKonsumsi = $crips['KonsumsiBBM'][$x];
        }

        //memberi nilai crips
        $arrayValueCrips = array(
            array(25, 50, 75, 100),
            array(25, 50, 75, 100),
            array(25, 50, 75, 100),
            array(25, 50, 75, 100)
        );
        
        //menyimpan nilai crips total
        $getCripsData = [];
        $iterasi = 0;
        for($i = 0; $i <$jumlahKriteria; $i++){
            for($j = 0; $j < 4; $j++){
                $iterasi = $iterasi + 1;
                $getCripsData[$kriteria[$i]['kriteria']][$j]['iterasi'] = $iterasi;
                $getCripsData[$kriteria[$i]['kriteria']][$j]['kode'] = $kriteria[$i]['kode'];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['nama'] = $kriteria[$i]['kriteria'];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['crips'] = $crips[$kriteria[$i]['kriteria']][$j];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['nilai'] = $arrayValueCrips[$i][$j];
            }
        }
        return $getCripsData;
    }

    public function getNilaiAlternatif($kriteria, $motor, $crips)
    {
        //dd($crips);
        //menghitung jumlah motor dan kriteria
        $jumlahMotor = count($motor);
        $jumlahKriteria = count($kriteria);

        //memberi nilai nilai alternatif sepeda motor
        $getNilaiAlternatif = [];
        for($i = 0; $i <$jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++) {
                for($k = 0; $k < 4; $k++){
                    $getNilaiAlternatif[$i]['nama'] = $motor[$i]['nama'];
                }
            }
        }
        for($i = 0; $i < $jumlahMotor; $i++){
            $getNilaiAlternatif[$i]['nama'] = $motor[$i]['nama'];
            for($j = 0; $j < $jumlahKriteria; $j++){
                for($k = 0; $k < 4; $k++){
                    if($motor[$i][$kriteria[$j]['kriteria']] <= $crips[$kriteria[$j]['kriteria']][$k]['crips'])
                    {
                        $getNilaiAlternatif[$i][$kriteria[$j]['kriteria']] = $crips[$kriteria[$j]['kriteria']][$k]['nilai'];
                        break;
                    }
                }
            }
        }
        return $getNilaiAlternatif;
    }

    public function getNormalisasi ($kriteria, $data, $jumlahMotor)
    {
        //menghitung jumlah kriteria
        $jumlahKriteria = count($kriteria);

        //inisilalisasi nilai maxmin
        $MaxMin = [];
        foreach($kriteria as $item){
            if($item['jenis'] == 'Cost'){
                $MaxMin[$item['kriteria']] = 99999999;
            } else {
                $MaxMin[$item['kriteria']] = 0;
            }
        }
        
        //memberi nilai minimal dan maksimal dari kriteria
        for($x = 0; $x < $jumlahKriteria; $x++){
            if($kriteria[$x]['jenis'] == 'Cost'){
                for($i = 0; $i < $jumlahMotor; $i++){
                    for($j = 0; $j < $jumlahMotor; $j++){
                        if($data[$j][$kriteria[$x]['kriteria']] < $MaxMin[$kriteria[$x]['kriteria']]){
                            $MaxMin[$kriteria[$x]['kriteria']] = $data[$i][$kriteria[$x]['kriteria']];
                        }   
                    }
                }
            }
            else {
                for($j = 0; $j < $jumlahMotor; $j++){
                    if($data[$j][$kriteria[$x]['kriteria']] > $MaxMin[$kriteria[$x]['kriteria']]){
                        $MaxMin[$kriteria[$x]['kriteria']] = $data[$j][$kriteria[$x]['kriteria']];
                    }   
                }
            }
        }
        
        //perhitungan rating normalisasi
        $ratingNormalisasi = array();

        for($i = 0; $i < $jumlahKriteria; $i++){
            for($j = 0; $j < $jumlahMotor; $j++){
                if($kriteria[$i]['jenis'] == 'Cost'){
                    $ratingNormalisasi[$j][$kriteria[$i]['kriteria']] = $MaxMin[$kriteria[$i]['kriteria']] / $data[$j][$kriteria[$i]['kriteria']];
                }
                else {
                    $ratingNormalisasi[$j][$kriteria[$i]['kriteria']] = $data[$j][$kriteria[$i]['kriteria']] / $MaxMin[$kriteria[$i]['kriteria']];
                }
            }
        }
        
        //menambahkan nama motor pada array ratingNormalisasi
        for($x = 0; $x < $jumlahMotor; $x++){
            $ratingNormalisasi[$x]['nama'] = $data[$x]['nama'];
        }
        
        return $ratingNormalisasi;
    }

    public function getRanking($data)
    {
        //menghitung jumlah motor
        $jumlahMotor = count($data);

        //query untuk mengambil data kriteria
        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:MemilikiBobot ?bobot}");
        
        //menyimpan data kriteria pada variabel
        $bobotKriteria = [];
        foreach($query as $item){
            array_push($bobotKriteria, [
                'kriteria'  => $this->parseData($item->kriteria->getUri()),
                'bobot'     => floatval($this->parseData($item->bobot->getValue()))
            ]);
        }
        //menghitung jumlah kriteria
        $jumlahKriteria = count($bobotKriteria);

        $hasilRekomendasi = [];
        //mengalikan nilai pada data motor dengan bobot pada kriteria
        for($i = 0; $i < $jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++){
                $hasilRekomendasi[$i][$bobotKriteria[$j]['kriteria']] = $data[$i][$bobotKriteria[$j]['kriteria']] * $bobotKriteria[$j]['bobot'];
            }
        }
        //menyimpan nama dan menghitung total pada masing-masing alternatif motor
        for($x = 0; $x < $jumlahMotor; $x++){
            $hasilRekomendasi[$x]['nama'] = $data[$x]['nama'];
        }
        $tempTotal = 0;
        for($i = 0; $i < $jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++){
                $tempTotal = $tempTotal + $hasilRekomendasi[$i][$bobotKriteria[$j]['kriteria']];
            }
            $hasilRekomendasi[$i]['total'] = $tempTotal;
            $tempTotal = 0;
        }
        return $hasilRekomendasi;
    }

    public function getResultSAW($data)
    {
        //menghitung jumlah motor
        $jumlahMotor = count($data);
        
        //query untuk mengambil nama kriteria
        $query = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria}");

        //menyimpan data kriteria dan menghitung jumlah kriteria
        $kriteria = [];
        foreach($query as $item){
            array_push($kriteria, $this->parseData($item->kriteria->getUri()));
        }
        $jumlahKriteria = count($kriteria);

        //menyimpan data nama dan nilai pada variabel hasilSAW dari variabel data
        $hasilSAW = [];
        for($i = 0; $i <$jumlahMotor; $i++){
            $hasilSAW[$i]['nama'] = $data[$i]['nama'];
            $hasilSAW[$i]['nilai'] = $data[$i]['total'];
        }

        //melakukan sorting dengan menggunakan bubblesort
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
