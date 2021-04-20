<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransmisiController extends Controller
{
    
    public function index()
    {
        //query untuk mengambil data transmisi motor dan disimpan pada variabel result
        $transmisi = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:Transmisi. ?s motor:MemilikiNama ?nama} ORDER BY ?s");
        $result = [];
        foreach($transmisi as $item){
            array_push($result, [
                'transmisi' => $this->parseData($item->s->getUri()),
                'nama'  => $this->parseData($item->nama->getValue())
            ]);
        }
        $data = [
            'hasiltransmisi' => $result
        ];
        return view('transmisi/index', $data);
    }

    public function show($transmisi)
    {
        //query untuk mengambil data motor berdasarkan transmisi tertentu dan disimpan pada variabel resul
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:AdalahJenisTransmisi motor:".$transmisi.". ?s motor:MemilikiNama ?n. ?s motor:MemilikiGambar ?gambar} ORDER BY ?s");
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
            'motor'         => $result,
            'jumlah'        => $jumlah,
            'transmisi'     => $transmisi
        ];
        return view('transmisi/list', $data);
    }
}
