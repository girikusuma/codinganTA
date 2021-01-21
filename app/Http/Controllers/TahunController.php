<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TahunController extends Controller
{
    
    public function index()
    {
        $tahun = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:TahunProduksi}");
        $result = [];
        foreach($tahun as $item){
            array_push($result, [
                'tahun' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'hasiltahun' => $result
        ];
        return view('tahunproduksi/index', $data);
    }

    public function show($tahun)
    {
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:MemilikiTahunProduksi motor:".$tahun.". ?s motor:MemilikiNama ?n}");
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
            'motor'     => $result,
            'jumlah'    => $jumlah,
            'tahun'     => $tahun
        ];
        return view('tahunproduksi/list', $data);
    }
}
