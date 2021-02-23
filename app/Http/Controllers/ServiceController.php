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

    public function detail($id)
    {
        $getDetail = $this->sparql->query("SELECT * WHERE {motor:".$id." motor:AdalahServiceCentreDari ?merek. motor:".$id." motor:MemilikiAlamat ?alamat. motor:".$id." motor:MemilikiJamBuka ?jamBuka. motor:".$id." motor:MemilikiJamTutup ?jamTutup. motor:".$id." motor:MemilikiNoTelp ?noTelp. motor:".$id." motor:MemilikiHariBuka ?hari. motor:".$id." motor:MemilikiNama ?nama. motor:".$id." motor:MemilikiGambar ?gambar}");
        $result = [];
        foreach($getDetail as $item){
            array_push($result, [
                'merek'     => $this->parseData($item->merek->getUri()),
                'nama'      => $this->parseData($item->nama->getValue()),
                'alamat'    => $this->parseData($item->alamat->getValue()),
                'jamBuka'   => $this->parseData($item->jamBuka->getValue()),
                'jamTutup'  => $this->parseData($item->jamTutup->getValue()),
                'noTelp'    => $this->parseData($item->noTelp->getValue()),
                'hariBuka'  => $this->parseData($item->hari->getValue()),
                'gambar'    => $this->parseData($item->gambar->getValue())
            ]);
        }
        $jumlah = count($result);
        $data = [
            'service'    => $result,
            'id'        => $id,
            'jumlah'    => $jumlah
        ];
        return view('servicecentre/detail', $data);
    }
}
