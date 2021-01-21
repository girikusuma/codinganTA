<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $type = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:JenisMotor}");
        $result = [];
        foreach($type as $item){
            array_push($result, [
                'type' => $this->parseData($item->s->getUri())
            ]);
        }
        $data = [
            'hasiltype' => $result
        ];
        return view('typemotor/index', $data);
    }

    public function show($type)
    {
        $getnama = $this->sparql->query("SELECT * WHERE {?s motor:MemilikiJenis motor:".$type.". ?s motor:MemilikiNama ?n}");
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
            'type'     => $type
        ];
        return view('typemotor/list', $data);
    }
}
