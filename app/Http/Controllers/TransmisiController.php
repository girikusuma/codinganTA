<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransmisiController extends Controller
{
    
    public function index()
    {
        $transmisi = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:Transmisi}");
        $result = [];
        foreach($transmisi as $item){
            array_push($result, [
                'transmisi' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'hasiltransmisi' => $result
        ];
        return view('transmisi/index', $data);
    }

    public function show($transmisi)
    {
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:AdalahJenisTransmisi motor:".$transmisi.". ?s motor:MemilikiNama ?n}");
        $result = [];
        $jumlah = 0;
        foreach($getnama as $item){
            array_push($result, [
                'id'    => $this->parseData($item->s->getUri()),
                'nama'  => $this->parseData($item->n->getValue())
            ]);
            $jumlah = $jumlah + 1;
        }
        $data = [
            'motor'         => $result,
            'jumlah'        => $jumlah,
            'transmisi'     => $transmisi
        ];
        return view('transmisi/list', $data);
    }
}
