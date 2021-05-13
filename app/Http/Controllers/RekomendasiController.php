<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        //query untuk mengambil data dari fuseki untuk select option
        $merek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:Merek. ?merek motor:MemilikiNama ?nama} ORDER BY ?merek');
        $transmisi = $this->sparql->query('SELECT * WHERE {?transmisi rdf:type motor:Transmisi.  ?transmisi motor:MemilikiNama ?nama} ORDER BY ?transmisi');
        $typemotor = $this->sparql->query('SELECT * WHERE {?typemotor rdf:type motor:Type.  ?typemotor motor:MemilikiNama ?nama} ORDER BY ?typemotor');
        $tahun = $this->sparql->query('SELECT * WHERE {?tahun rdf:type motor:TahunProduksi.  ?tahun motor:MemilikiNama ?nama} ORDER BY ?tahun');
        $volume = $this->sparql->query('SELECT * WHERE {?volume rdf:type motor:VolumeSilinder.  ?volume motor:MemilikiNama ?nama} ORDER BY ?volume');
        
        $resultMerek = [];
        $resultTransmisi = [];
        $resultType = [];
        $resultTahun = [];
        $resultVolume = [];
        
        //mengambl data dari fuseki server
        foreach($merek as $item){
            array_push($resultMerek, [
                'hasilMerek' => $this->parseData($item->merek->getUri()),
                'namaMerek'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($transmisi as $item){
            array_push($resultTransmisi, [
                'hasilTransmisi' => $this->parseData($item->transmisi->getUri()),
                'namaTransmisi'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($typemotor as $item){
            array_push($resultType, [
                'hasilType' => $this->parseData($item->typemotor->getUri()),
                'namaType'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($tahun as $item){
            array_push($resultTahun, [
                'hasilTahun' => $this->parseData($item->tahun->getUri()),
                'namaTahun'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($volume as $item){
            array_push($resultVolume, [
                'hasilVolume' => $this->parseData($item->volume->getUri()),
                'namaVolume'  => $this->parseData($item->nama->getValue())
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
            
            $sql = $sql.". ?motor motor:MemilikiHarga ?harga. ?motor motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. ?motor motor:MemilikiVolumeSilinder ?volume. ?motor motor:MemilikiKapasitasBahanBakar ?kapasitas. ?motor motor:MemilikiNama ?nama}";

            $resultMotor = [];
            
            $query = $this->sparql->query($sql);

            //menyimpan data sepeda motor pada variabel $resultMotor
            $kodeAlternatif = 1;
            foreach($query as $item){
                array_push($resultMotor, [
                    'nama'              => $this->parseData($item->nama->getValue()),
                    'Harga'             => intval($this->parseData($item->harga->getValue())),
                    'KapasitasBBM'      => floatval($this->parseData($item->kapasitas->getValue())),
                    'VolumeSilinder'    => $this->parseData($item->volume->getUri()),
                    'KonsumsiBBM'       => floatval($this->parseData($item->tingkatbbm->getValue())),
                    'kode'              => "A".$kodeAlternatif
                ]);
                $kodeAlternatif = $kodeAlternatif + 1;
            }

            //query untuk mengambil data kriteria dari fuseki server
            $sqlkriteria = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:AdalahJenisKriteria ?jenis} ORDER BY ?kriteria");
            
            //menyimpan data kriteria pada variabel $getKriteria
            $getKriteria = [];
            $kode = 1;
            foreach($sqlkriteria as $item){
                if($this->parseData($item->kriteria->getUri()) == "Harga"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->Harga),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "KapasitasBBM"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->KapasitasBBM),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "KonsumsiBBM"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->KonsumsiBBM),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "VolumeSilinder"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->VolumeSilinder),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
            }
        } else {
            $resultMotor = [];
            $jumlahMotor = count($request->motor);
            //mengambil data motor dari request dan menyimpan ke sebuah array
            for($x = 0; $x < $jumlahMotor; $x++){
                $query = $this->sparql->query('SELECT * WHERE {motor:'.$request->motor[$x].' rdf:type motor:Motor. motor:'.$request->motor[$x].' motor:MemilikiHarga ?harga. motor:'.$request->motor[$x].' motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. motor:'.$request->motor[$x].' motor:MemilikiVolumeSilinder ?volume. motor:'.$request->motor[$x].' motor:MemilikiKapasitasBahanBakar ?kapasitas. motor:'.$request->motor[$x].' motor:MemilikiNama ?nama}');
                foreach($query as $item){
                    array_push($resultMotor, [
                        'nama'              => $this->parseData($item->nama->getValue()),
                        'Harga'             => intval($this->parseData($item->harga->getValue())),
                        'KapasitasBBM'      => floatval($this->parseData($item->kapasitas->getValue())),
                        'VolumeSilinder'    => $this->parseData($item->volume->getUri()),
                        'KonsumsiBBM'       => floatval($this->parseData($item->tingkatbbm->getValue())),
                        'kode'              => "A".($x+1)
                    ]);
                }
            }
            //query untuk mengambil data kriteria dari fuseki server
            $sqlkriteria = $this->sparql->query("SELECT * WHERE {?kriteria rdf:type motor:NamaKriteria. ?kriteria motor:AdalahJenisKriteria ?jenis} ORDER BY ?kriteria");
            
            //menyimpan data kriteria pada variabel $getKriteria
            $getKriteria = [];
            $kode = 1;
            foreach($sqlkriteria as $item){
                if($this->parseData($item->kriteria->getUri()) == "Harga"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->Harga),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "KapasitasBBM"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->KapasitasBBM),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "KonsumsiBBM"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->KonsumsiBBM),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
                else if($this->parseData($item->kriteria->getUri()) == "VolumeSilinder"){
                    array_push($getKriteria, [
                        'kriteria'  => $this->parseData($item->kriteria->getUri()),
                        'jenis'     => $this->parseData($item->jenis->getUri()),
                        'bobot'     => floatval($request->VolumeSilinder),
                        'kode'      => "C".$kode
                    ]);
                    $kode += 1;
                }
            }
        }
        $jumlah = count($resultMotor);

        //memanggil fungsi getCrips untuk memberi nilai pada table Data Crips
        $cripsData = $this->getCrips($getKriteria);

        //memanggil fungsi getNilaiLaternatif untuk memberi nilai pada tabel Data Nilai Alternatif
        $nilaiAlternatif = $this->getNilaiAlternatif($getKriteria, $resultMotor, $cripsData);
        
        //memanggil fungsi getNormalisasi untuk memberi nilai pada tabel Hasil Normalisasi
        $normalisasi = $this->getNormalisasi($getKriteria, $nilaiAlternatif, $jumlah);

        //memanggil fungsi getRanking untuk memberi nilai pada tabel Nilai Pembobotan
        $rankingData = $this->getRanking($normalisasi, $getKriteria);

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
        $query = $this->sparql->query("SELECT * WHERE {?motor rdf:type motor:Motor. ?motor motor:MemilikiHarga ?harga. ?motor motor:MemilikiTingkatKonsumsiBahanBakar ?tingkatbbm. ?motor motor:MemilikiVolumeSilinder ?volume. ?motor motor:MemilikiKapasitasBahanBakar ?kapasitas}");
        $motor = [];
        //meyimpan data sepeda motor pada variabel $motor
        foreach($query as $item){
            array_push($motor, [
                'motor'             => $this->parseData($item->motor->getUri()),
                'Harga'             => intval($this->parseData($item->harga->getValue())),
                'KapasitasBBM'      => floatval($this->parseData($item->kapasitas->getValue())),
                'VolumeSilinder'    => $this->parseData($item->volume->getUri()),
                'KonsumsiBBM'       => floatval($this->parseData($item->tingkatbbm->getValue()))
            ]);
        }

        $query2 = $this->sparql->query("SELECT * WHERE {?volume rdf:type motor:VolumeSilinder} ORDER BY ?volume");
        $VolumeS = [];
        foreach($query2 as $item){
            array_push($VolumeS, [
                'id'    => $this->parseData($item->volume->getUri())
            ]);
        }
        $jumlahVolume = count($VolumeS);

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
        $rasio = ($maxHarga - $minHarga)/$jumlahVolume;

        $tempHarga = $minHarga;
        for($x = 0; $x < $jumlahVolume; $x++){
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
        $rasio = ($maxKapasitas - $minKapasitas)/$jumlahVolume;

        $tempKapasitas = $minKapasitas;
        for($x = 0; $x < $jumlahVolume; $x++){
            $crips['KapasitasBBM'][$x] = $tempKapasitas + $rasio;
            $tempKapasitas = $crips['KapasitasBBM'][$x];
        }

        //nilai crips volume
        $arrayVolume = [];
        for($x = 0; $x < $jumlahVolume; $x++){
            $crips['VolumeSilinder'][$x] = $VolumeS[$x]['id'];
        }

        //cek maxmin konsumsi dan mencari nilai crips konsumsi
        $arrayKonsumsi = [];
        for($x = 0; $x < $jumlahMotor; $x++){
            $arrayKonsumsi[$x] = $motor[$x]['KonsumsiBBM'];
        }
        $maxKonsumsi = max($arrayKonsumsi);
        $minKonsumsi = min($arrayKonsumsi);
        $rasio = ($maxKonsumsi - $minKonsumsi)/$jumlahVolume;

        $tempKonsumsi = $minKonsumsi;
        for($x = 0; $x < $jumlahVolume; $x++){
            $crips['KonsumsiBBM'][$x] = $tempKonsumsi + $rasio;
            $tempKonsumsi = $crips['KonsumsiBBM'][$x];
        }

        //memberi nilai crips
        $arrayValueCrips = [];
        for($i = 0; $i < $jumlahVolume; $i++){
            $r = 100 / $jumlahVolume;
            $tempR = 0;
            for($j = 0; $j < $jumlahVolume; $j++){
                $arrayValueCrips[$i][$j] = $tempR + $r;
                $tempR = $arrayValueCrips[$i][$j];
            }
        }
        
        //menyimpan nilai crips total
        $getCripsData = [];
        $iterasi = 0;
        for($i = 0; $i <$jumlahKriteria; $i++){
            for($j = 0; $j < $jumlahVolume; $j++){
                $iterasi = $iterasi + 1;
                $getCripsData[$kriteria[$i]['kriteria']][$j]['iterasi'] = $iterasi;
                $getCripsData[$kriteria[$i]['kriteria']][$j]['kode'] = $kriteria[$i]['kode'];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['nama'] = $kriteria[$i]['kriteria'];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['crips'] = $crips[$kriteria[$i]['kriteria']][$j];
                $getCripsData[$kriteria[$i]['kriteria']][$j]['nilai'] = $arrayValueCrips[$i][$j];
                if($kriteria[$i]['kriteria'] == "VolumeSilinder"){
                    $getCripsData[$kriteria[$i]['kriteria']][$j]['text'] = $crips[$kriteria[$i]['kriteria']][$j];
                } else {
                    $getCripsData[$kriteria[$i]['kriteria']][$j]['text'] = "<= ".$crips[$kriteria[$i]['kriteria']][$j];                    
                }
            }
        }
        return $getCripsData;
    }

    public function getNilaiAlternatif($kriteria, $motor, $crips)
    {
        $query2 = $this->sparql->query("SELECT * WHERE {?volume rdf:type motor:VolumeSilinder} ORDER BY ?volume");
        $VolumeS = [];
        foreach($query2 as $item){
            array_push($VolumeS, [
                'id'    => $this->parseData($item->volume->getUri())
            ]);
        }
        $jumlahVolume = count($VolumeS);
        //menghitung jumlah motor dan kriteria
        $jumlahMotor = count($motor);
        $jumlahKriteria = count($kriteria);
        
        //memberi nilai nilai alternatif sepeda motor
        $getNilaiAlternatif = [];
        for($i = 0; $i <$jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++) {
                for($k = 0; $k < $jumlahVolume; $k++){
                    $getNilaiAlternatif[$i]['nama'] = $motor[$i]['nama'];
                    $getNilaiAlternatif[$i]['kode'] = $motor[$i]['kode'];
                }
            }
        }
        for($i = 0; $i < $jumlahMotor; $i++){
            for($j = 0; $j < $jumlahKriteria; $j++){
                if(strcmp($kriteria[$j]['kriteria'], 'VolumeSilinder') == 1){
                    for($m = 0; $m < $jumlahVolume; $m++){
                        if($motor[$i][$kriteria[$j]['kriteria']] == $VolumeS[$m]){
                            $getNilaiAlternatif[$i][$kriteria[$j]['kriteria']] = $crips[$kriteria[$j]['kriteria']][$m]['nilai'];
                            break;
                        }
                    }
                } else {
                    for($k = 0; $k < $jumlahVolume; $k++){
                        if($motor[$i][$kriteria[$j]['kriteria']] <= $crips[$kriteria[$j]['kriteria']][$k]['crips']){
                            $getNilaiAlternatif[$i][$kriteria[$j]['kriteria']] = $crips[$kriteria[$j]['kriteria']][$k]['nilai'];
                            break;
                        }
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
                $MaxMin[$item['kriteria']] = 9999999999;
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
                    $ratingNormalisasi[$j][$kriteria[$i]['kriteria']] = number_format($MaxMin[$kriteria[$i]['kriteria']] / $data[$j][$kriteria[$i]['kriteria']], 2);
                }
                else {
                    $ratingNormalisasi[$j][$kriteria[$i]['kriteria']] = number_format($data[$j][$kriteria[$i]['kriteria']] / $MaxMin[$kriteria[$i]['kriteria']], 2);
                }
            }
        }
        
        //menambahkan nama motor pada array ratingNormalisasi
        for($x = 0; $x < $jumlahMotor; $x++){
            $ratingNormalisasi[$x]['nama'] = $data[$x]['nama'];
        }
        
        return $ratingNormalisasi;
    }

    public function getRanking($data, $bobotKriteria)
    {
        //menghitung jumlah motor
        $jumlahMotor = count($data);

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
