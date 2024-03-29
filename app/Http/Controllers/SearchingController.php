<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchingController extends Controller
{
    public function index(Request $request){
        //untuk mengetahui apakan terdapat request dari user
        if($request->has('cari')){
            $status = 1;
            //untuk membangun query berdasarkan kriteria filter motor
            $sql = 'SELECT * WHERE { ?motor rdf:type motor:Motor';
            if($request->cari_merek != 'semua'){
                $sql = $sql.'. ?motor motor:AdalahMerkDari motor:'.$request->cari_merek;
            }
            if($request->cari_transmisi != 'semua'){
                $sql = $sql.'. ?motor motor:AdalahJenisTransmisi motor:'.$request->cari_transmisi;
            }
            if($request->cari_typemotor != 'semua'){
                $sql = $sql.'. ?motor motor:MemilikiJenis motor:'.$request->cari_typemotor;
            }
            if($request->cari_tahun != 'semua'){
                $sql = $sql.'. ?motor motor:MemilikiTahunProduksi motor:'.$request->cari_tahun;
            }
            if($request->cari_volume != 'semua'){
                $sql = $sql.'. ?motor motor:MemilikiVolumeSilinder motor:'.$request->cari_volume;
            }
            $sql = $sql.'. ?motor motor:MemilikiNama ?nama}';

            $querydata = $this->sparql->query($sql);

            $resultMotor = [];
            $resultDealer = [];
            $resultService = [];

            //meyimpan data nama dan id motor
            foreach($querydata as $item){
                array_push($resultMotor, [
                    'id'        => $this->parseData($item->motor->getUri()),
                    'nama'      => $this->parseData($item->nama->getValue())
                ]);
            }

            $getMerek = $request->cari_merek;
            $getTransmisi = $request->cari_transmisi;
            $getJenis = $request->cari_typemotor;
            $getTahun = $request->cari_tahun;
            $getVolume = $request->cari_volume;
            $getLokasi = '';

            $jumlahMotor = count($resultMotor);
            $jumlahDealer = 0;
            $jumlahService = 0;

        } else if($request->has('cari_dealer')){ 
            $status = 2;
            //untuk membangun query berdasarkan kriteria filter dealer
            $sql = 'SELECT * WHERE { ?dealer rdf:type motor:Dealer';
            if($request->cari_merek_dealer != 'semua'){
                $sql = $sql.'. ?dealer motor:AdalahDealerDari motor:'.$request->cari_merek_dealer;
            }
            if($request->cari_lokasi_dealer != 'semua'){
                $sql = $sql.'. ?dealer motor:MemilikiLokasi motor:'.$request->cari_lokasi_dealer;
            }
            $sql = $sql.'. ?dealer motor:MemilikiNama ?nama}';

            $querydata = $this->sparql->query($sql);

            $resultMotor = [];
            $resultDealer = [];
            $resultService = [];

            //meyimpan data nama dan id dealer
            foreach($querydata as $item){
                array_push($resultDealer, [
                    'id'        => $this->parseData($item->dealer->getUri()),
                    'nama'      => $this->parseData($item->nama->getValue())
                ]);
            }

            $getMerek = $request->cari_merek_dealer;
            $getTransmisi = '';
            $getJenis = '';
            $getTahun = '';
            $getVolume = '';
            $getLokasi = $request->cari_lokasi_dealer;

            $jumlahMotor = 0;
            $jumlahDealer = count($resultDealer);
            $jumlahService = 0;

        } else if($request->has('cari_service')){ 
            $status = 3;
            //untuk membangun query berdasarkan kriteria filter service center
            $sql = 'SELECT * WHERE { ?service rdf:type motor:ServiceCenter';
            if($request->cari_merek_service != 'semua'){
                $sql = $sql.'. ?service motor:AdalahServiceCentreDari motor:'.$request->cari_merek_service;
            }
            if($request->cari_lokasi_service != 'semua'){
                $sql = $sql.'. ?service motor:MemilikiLokasi motor:'.$request->cari_lokasi_service;
            }
            $sql = $sql.'. ?service motor:MemilikiNama ?nama}';

            $querydata = $this->sparql->query($sql);

            $resultMotor = [];
            $resultDealer = [];
            $resultService = [];

            //meyimpan data nama dan id service center
            foreach($querydata as $item){
                array_push($resultService, [
                    'id'        => $this->parseData($item->service->getUri()),
                    'nama'      => $this->parseData($item->nama->getValue())
                ]);
            }

            $getMerek = $request->cari_merek_service;
            $getTransmisi = '';
            $getJenis = '';
            $getTahun = '';
            $getVolume = '';
            $getLokasi = $request->cari_lokasi_service;

            $jumlahMotor = 0;
            $jumlahDealer = 0;
            $jumlahService = count($resultService);

        } else {
            $sql = '';
            $getMerek = '';
            $getTransmisi = '';
            $getJenis = '';
            $getTahun = '';
            $getVolume = '';
            $getLokasi = '';
            $resultMotor = [];
            $resultDealer = [];
            $resultService = [];
            $status = 0;
            $jumlahMotor = 0;
            $jumlahDealer = 0;
            $jumlahService = 0;
            $merek = "semua";
            $transmisi = "semua";
            $jenis = "semua";
            $tahun = "semua";
            $volume = "semua";
        }
        //melakukan query untuk mengambil data merek, transmisi, type, tahun, volume, dan lokasi
        $merek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:Merek. ?merek motor:MemilikiNama ?nama} ORDER BY ?merek');
        $transmisi = $this->sparql->query('SELECT * WHERE {?transmisi rdf:type motor:Transmisi. ?transmisi motor:MemilikiNama ?nama} ORDER BY ?transmisi');
        $typemotor = $this->sparql->query('SELECT * WHERE {?typemotor rdf:type motor:Type. ?typemotor motor:MemilikiNama ?nama} ORDER BY ?typemotor');
        $tahun = $this->sparql->query('SELECT * WHERE {?tahun rdf:type motor:TahunProduksi. ?tahun motor:MemilikiNama ?nama} ORDER BY ?tahun');
        $volume = $this->sparql->query('SELECT * WHERE {?volume rdf:type motor:VolumeSilinder. ?volume motor:MemilikiNama ?nama} ORDER BY ?volume');
        $lokasi = $this->sparql->query('SELECT * WHERE {?lokasi rdf:type motor:Kabupaten. ?lokasi motor:MemilikiNama ?nama} ORDER BY ?lokasi');
        
        $resultMerek = [];
        $resultTransmisi = [];
        $resultType = [];
        $resultTahun = [];
        $resultVolume = [];
        $resultLokasi = [];
        
        foreach($merek as $item){
            array_push($resultMerek, [
                'hasilMerek' => $this->parseData($item->merek->getUri()),
                'namamerek'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($transmisi as $item){
            array_push($resultTransmisi, [
                'hasilTransmisi' => $this->parseData($item->transmisi->getUri()),
                'namatransmisi'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($typemotor as $item){
            array_push($resultType, [
                'hasilType' => $this->parseData($item->typemotor->getUri()),
                'namatype'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($tahun as $item){
            array_push($resultTahun, [
                'hasilTahun' => $this->parseData($item->tahun->getUri()),
                'namatahun'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($volume as $item){
            array_push($resultVolume, [
                'hasilVolume' => $this->parseData($item->volume->getUri()),
                'namavolume'  => $this->parseData($item->nama->getValue())
            ]);
        }
        foreach($lokasi as $item){
            array_push($resultLokasi, [
                'hasilLokasi' => $this->parseData($item->lokasi->getUri()),
                'namalokasi'  => $this->parseData($item->nama->getValue())
            ]);
        }
        $data = [
            'getMerek'      => $resultMerek,
            'getTransmisi'  => $resultTransmisi,
            'getType'       => $resultType,
            'getTahun'      => $resultTahun,
            'getVolume'     => $resultVolume,
            'getMotor'      => $resultMotor,
            'getDealer'     => $resultDealer,
            'getService'    => $resultService,
            'getLokasi'     => $resultLokasi,
            'status'        => $status,
            'query'         => $sql,
            'jumlahMotor'   => $jumlahMotor,
            'jumlahDealer'  => $jumlahDealer,
            'jumlahService' => $jumlahService,
            'merek'         => $getMerek,
            'transmisi'     => $getTransmisi,
            'jenis'         => $getJenis,
            'tahun'         => $getTahun,
            'volume'        => $getVolume,
            'lokasi'        => $getLokasi
        ];

        return view ('searching', $data);
    }
}