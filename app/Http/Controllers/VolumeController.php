<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolumeController extends Controller
{
    
    public function index()
    {
        $volume = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:VolumeSilinder}");
        $result = [];
        foreach($volume as $item){
            array_push($result, [
                'volume' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'hasilvolume' => $result
        ];
        return view('volumesilinder/index', $data);
    }

    public function show($volume)
    {
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:MemilikiVolumeSilinder motor:".$volume.". ?s motor:MemilikiNama ?n. ?s motor:MemilikiGambar ?gambar}");
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
