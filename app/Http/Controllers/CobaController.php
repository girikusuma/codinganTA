<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index(){
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

        return view ('coba', $data);
    }

    public function filterData(Request $request)
    {
        $orderBy = "motor.merek";
        switch($request->input('order.0.column')){
            case "0" :
                $orderBy = "motor.merek";
                break;
            case "1" :
                $orderBy = "motor.transmisi";
                break;
            case "2" :
                $orderBy = "motor.type";
                break;
            case "3" :
                $orderBy = "motor.tahun";
                break;
            case "4" :
                $orderBy = "motor.volume";
                break;
        }

        $merek = '?merek';
        $transmisi = '?transmisi';
        $typemotor = '?typemotor';
        $tahun = '?tahun';
        $volume = '?volume';

        $query = $this->sparql->query("SELECT * WHERE {?motor motor:AdalahMerkDari ".$merek.". ?motor motor:AdalahJenisTransmisi ".$transmisi.". ?motor motor:MemilikiTahunProduksi ".$tahun.". ?motor motor:MemilikiJenis ".$typemotor.". ?motor motor:MemilikiVolumeSilinder ".$volume.". ?motor motor:MemilikiNama ?nama}");
        $data = [];
        foreach($query as $item){
            array_push($data, [
                'nama'      => $this->parseData($item->nama->getValue()),
                'merek'     => $this->parseData($item->merek->getUri()),
                'transmisi' => $this->parseData($item->transmisi->getUri()),
                'type'      => $this->parseData($item->typemotor->getUri()),
                'tahun'     => $this->parseData($item->tahun->getUri()),
                'volume'    => $this->parseData($item->volume->getUri())
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }
}