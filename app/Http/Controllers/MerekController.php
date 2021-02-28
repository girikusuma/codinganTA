<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerekController extends Controller
{

    public function index()
    {
        //query untuk mengambil data merek motor dan disimpan pada variabel result
        $merek = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:MerkMotor}");
        $result = [];
        foreach($merek as $item){
            array_push($result, [
                'namamerek' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'merek' => $result
        ];

        return view('merekmotor/index', $data);
    }
    
    public function show($merek)
    {
        //query untuk mengambil data motor berdasarkan merek tertentu dan disimpan pada variabel result
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:AdalahMerkDari motor:".$merek.". ?s motor:MemilikiNama ?n. ?s motor:MemilikiGambar ?gambar}");
        $result = [];
        $jumlah = 0;
        foreach($getnama as $item){
            array_push($result, [
                'id'        => $this->parseData($item->s->getUri()),
                'nama'      => $this->parseData($item->n->getValue()),
                'gambar'     => $this->parseData($item->gambar->getValue())
            ]);
            $jumlah = $jumlah + 1;
        }
        $data = [
            'motor'     => $result,
            'jumlah'    => $jumlah,
            'merek'     => $merek
        ];

        return view('merekmotor/list', $data);
    }
}
