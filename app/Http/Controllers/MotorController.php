<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MotorController extends Controller
{
    public function menu()
    {   
        //query untuk mengambil data motor, merek, transmisi, type, tahun, dan volume
        $motor = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:NamaUnit. ?s motor:MemilikiNama ?o}');
        $merek = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:MerkMotor}');
        $transmisi = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:Transmisi}');
        $type = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:JenisMotor}');
        $tahun = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:TahunProduksi}');
        $volume = $this->sparql->query('SELECT * WHERE {?s rdf:type motor:VolumeSilinder}');
        $jumlahMotor = $jumlahMerek = $jumlahTransmisi = $jumlahType = $jumlahTahun = $jumlahVolume = 0;
        foreach($motor as $item){
            $jumlahMotor = $jumlahMotor + 1;
        }
        foreach($merek as $item){
            $jumlahMerek = $jumlahMerek + 1;
        }
        foreach($transmisi as $item){
            $jumlahTransmisi = $jumlahTransmisi + 1;
        }
        foreach($type as $item){
            $jumlahType = $jumlahType + 1;
        }
        foreach($tahun as $item){
            $jumlahTahun = $jumlahTahun + 1;
        }
        foreach($volume as $item){
            $jumlahVolume = $jumlahVolume + 1;
        }
        $data = array(
            'jumlahMotor'       => $jumlahMotor,
            'jumlahMerek'       => $jumlahMerek,
            'jumlahTransmisi'   => $jumlahTransmisi,
            'jumlahType'        => $jumlahType,
            'jumlahTahun'       => $jumlahTahun,
            'jumlahVolume'      => $jumlahVolume
        );
        return view ('sepedamotor/menu', ['data' => $data]);
    }
    
    public function index()
    {
        //query untuk mengambil data motor dan disimpan pada variabel result
        $motor = $this->sparql->query("SELECT * WHERE {?s rdf:type motor:NamaUnit. ?s motor:MemilikiNama ?o. ?s motor:MemilikiGambar ?gambar}");

        $result = [];
        foreach($motor as $item){
            array_push($result, [
                'hasilmotor' => $this->parseData($item->o->getValue()),
                'idmotor'    => $this->parseData($item->s->getUri()),
                'gambar'     => $this->parseData($item->gambar->getValue())
            ]);
        }

        $data = [
            'motor' => $result
        ];

        // parsing $result ke fungsi getPagination
        // $data = $this->getPagination($result);

        return view ('sepedamotor/index', $data);
        
        // return view untuk pagination
        // return view ('sepedamotor/index', compact('data'));
    }

    // fungsi getPagination untuk melakukan paging
    public function getPagination($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function show($idmotor)
    {
        //query untuk mengambil data nama motor
        $getnama = $this->sparql->query("SELECT * WHERE {motor:".$idmotor." motor:MemilikiNama ?n}");

        foreach($getnama as $i){
            $nama = $this->parseData($i->n->getValue());
        }

        //query untuk mengambil semua data pad satu motor
        $sql = $this->sparql->query("SELECT * WHERE {motor:".$idmotor." motor:AdalahJenisTransmisi ?t. motor:".$idmotor." motor:AdalahMerkDari ?m. motor:".$idmotor." motor:MemilikiSistemBahanBakar ?sb. motor:".$idmotor." motor:MemilikiJenis ?j. motor:".$idmotor." motor:MemilikiVolumeSilinder ?v . motor:".$idmotor." motor:MemilikiTahunProduksi ?tp. motor:".$idmotor." motor:MemilikiTingkatKonsumsiBahanBakar ?konsumsi. motor:".$idmotor." motor:MemilikiKecepatan ?kecepatan. motor:".$idmotor." motor:MemilikiKapasitasBahanBakar ?kapasitas. motor:".$idmotor." motor:MemilikiDimensiLebar ?L. motor:".$idmotor." motor:MemilikiDimensiTinggi ?T. motor:".$idmotor." motor:MemilikiDimensiPanjang ?P. motor:".$idmotor." motor:MemilikiHarga ?harga. motor:".$idmotor." motor:MemilikiGambar ?gambar}");
        $jumlah = 0;
        foreach($sql as $item){
            $jumlah = $jumlah + 1;
        }
        $result = [];
        foreach($sql as $item){
            array_push($result, [
                'transmisi'     => $this->parseData($item->t->getUri()),
                'type'          => $this->parseData($item->j->getUri()),
                'merek'         => $this->parseData($item->m->getUri()),
                'sistem'        => $this->parseData($item->sb->getUri()),
                'volume'        => $this->parseData($item->v->getUri()),
                'tahun'         => $this->parseData($item->tp->getUri()),
                'konsumsi'      => $this->parseData($item->konsumsi->getValue()),
                'kecepatan'     => $this->parseData($item->kecepatan->getValue()),
                'kapasitas'     => $this->parseData($item->kapasitas->getValue()),
                'lebar'         => $this->parseData($item->L->getValue()),
                'tinggi'        => $this->parseData($item->T->getValue()),
                'panjang'       => $this->parseData($item->P->getValue()),
                'harga'         => $this->parseData($item->harga->getValue()),
                'namagambar'    => $this->parseData($item->gambar->getValue())
            ]);
        }

        $data = [
            'motor'     => $result,
            'nama'      => $nama,
            'jumlah'    => $jumlah
        ];
        return view('sepedamotor/detail', $data);
    }
}
