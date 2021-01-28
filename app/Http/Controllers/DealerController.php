<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
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
        return view('dealer/index', $data);
    }

    public function location($provinsi)
    {
        $kabupaten = $this->sparql->query('SELECT * WHERE {?s motor:AdalahBagianDari motor:'.$provinsi.'}');
        $result = [];
        foreach($kabupaten as $item){
            $nama = $this->parseData($item->s->getUri());
            $jumlah = 0;
            $getNamaMotor = $this->sparql->query('SELECT * WHERE {?s motor:MemilikiLokasi motor:'.$nama.'. ?s rdf:type motor:NamaDealer}');
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
        return view('dealer/daerah', $data);
    }

    public function show($provinsi, $kabupaten)
    {
        $getMerek = $this->sparql->query('SELECT * WHERE {?merek rdf:type motor:MerkMotor}');
        $resultMerek = [];
        $resultDealer = [];
        foreach($getMerek as $item){
            array_push($resultMerek, [
                'merek' => $this->parseData($item->merek->getUri())
            ]);
        }
        foreach($resultMerek as $getDealer){
            $Dealer = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:NamaDealer. ?s motor:MemilikiLokasi motor:'.$kabupaten.'. ?s motor:AdalahDealerDari motor:'.$getDealer['merek'].'}');
            foreach($Dealer as $item){
                array_push($resultDealer, [
                    'id'            => $this->parseData($item->s->getUri()),
                    'merekDealer'   => $getDealer['merek']
                ]);
            }
        }
        $data = [
            'getMerek'  => $resultMerek,
            'getDealer' => $resultDealer,
            'provinsi'  => $provinsi,
            'kabupaten' => $kabupaten
        ];
        return view('dealer/list', $data);
    }

    public function detail($provinsi, $kabupaten, $id)
    {
        $getDetail = $this->sparql->query("SELECT * WHERE {motor:".$id." motor:AdalahDealerDari ?merek. motor:".$id." motor:MemilikiAlamat ?alamat. motor:".$id." motor:MemilikiJamBuka ?jamBuka. motor:".$id." motor:MemilikiJamTutup ?jamTutup. motor:".$id." motor:MemilikiNoTelp ?noTelp}");
        $result = [];
        foreach($getDetail as $item){
            array_push($result, [
                'merek'     => $this->parseData($item->merek->getUri()),
                'alamat'    => $this->parseData($item->alamat->getValue()),
                'jamBuka'   => $this->parseData($item->jamBuka->getValue()),
                'jamTutup'  => $this->parseData($item->jamTutup->getValue()),
                'noTelp'    => $this->parseData($item->noTelp->getValue())
            ]);
        }
        $data = [
            'dealer'    => $result,
            'id'        => $id
        ];
        return view('dealer/detail', $data);
    }
}