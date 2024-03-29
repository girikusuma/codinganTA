<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolumeController extends Controller
{
    
    public function index()
    {
        //query untuk mengambil data volume silinder motor dan disimpan pada variabel result
        $volume = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:VolumeSilinder. ?s motor:MemilikiNama ?nama} ORDER BY ?s");
        $result = [];
        foreach($volume as $item){
            array_push($result, [
                'volume' => $this->parseData($item->s->getUri()),
                'nama'  => $this->parseData($item->nama->getValue())
            ]);
        }
        $data = [
            'hasilvolume' => $result
        ];
        return view('volumesilinder/index', $data);
    }

    public function show($volume)
    {
        //query untuk mengambil data motor berdasarkan volume silinder tertentu dan disimpan pada variabel result
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:MemilikiVolumeSilinder motor:".$volume.". ?s motor:MemilikiNama ?n. ?s motor:MemilikiGambar ?gambar} ORDER BY ?s");
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
            'motor'      => $result,
            'jumlah'     => $jumlah,
            'volume'     => $volume
        ];
        return view('volumesilinder/list', $data);
    }
}
