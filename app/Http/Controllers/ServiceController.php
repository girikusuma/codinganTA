<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $provinsi = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:Provinsi}');
        $result = [];
        foreach($provinsi as $item){
            array_push($result, [
                'provinsi' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'hasilprovinsi' => $result
        ];
        return view('servicecentre/index', $data);
    }

    public function location($provinsi)
    {
        $kabupaten = $this->sparql->query('SELECT * WHERE {?s motor:AdalahBagianDari motor:'.$provinsi.'}');
        $result = [];
        foreach($kabupaten as $item){
            $nama = $this->parseData($item->s->getUri());
            $jumlah = 0;
            $getNamaMotor = $this->sparql->query('SELECT * WHERE {?s motor:MemilikiLokasi motor:'.$nama.'. ?s rdf:type motor:NamaServiceCentre}');
            foreach($getNamaMotor as $motor){
                $jumlah = $jumlah + 1;
            }
            array_push($result, [
                'namaKabupaten' => $nama,
                'jumlah'        => $jumlah
            ]);
        }
        $data = [
            'kabupaten' => $result,
            'provinsi'  => $provinsi
        ];
        return view('servicecentre/daerah', $data);
    }

    public function show($provinsi, $kabupaten)
    {
        $getMerek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:MerkMotor}');
        $resultMerek = [];
        $resultService = [];
        foreach($getMerek as $item){
            array_push($resultMerek, [
                'merek' => $this->parseData($item->merek->getUri())
            ]);
        }
        foreach($resultMerek as $getService){
            $Service = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:NamaServiceCentre. ?s motor:MemilikiLokasi motor:'.$kabupaten.'. ?s motor:AdalahServiceCentreDari motor:'.$getService['merek'].'}');
            foreach($Service as $item){
                array_push($resultService, [
                    'id'            => $this->parseData($item->s->getUri()),
                    'merekService'   => $getService['merek']
                ]);
            }
        }
        $data = [
            'getMerek'      => $resultMerek,
            'getService'    => $resultService,
            'provinsi'      => $provinsi,
            'kabupaten'     => $kabupaten
        ];
        return view('servicecentre/list', $data);
    }

    public function detail($id, $id2, $id3)
    {
        return view('servicecentre/detail', ['provinsi' => $id, 'kabupaten' => $id2, 'service' => $id3]);
    }
}
