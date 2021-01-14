<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$qr = "SELECT * WHERE {motor:".$idmotor." motor:MemilikiNama ?n}";
$getnama = $sparql->query($qr);
foreach($getnama as $i){
  $nama = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$i->n->getValue());
}
?>
@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $nama }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <?php
        $sql = "SELECT * WHERE {motor:".$idmotor." motor:AdalahJenisTransmisi ?t. motor:".$idmotor." motor:AdalahMerkDari ?m. motor:".$idmotor." motor:MemilikiSistemBahanBakar ?sb. motor:".$idmotor." motor:MemilikiJenis ?j. motor:".$idmotor." motor:MemilikiVolumeSilinder ?v . motor:".$idmotor." motor:MemilikiTahunProduksi ?tp. motor:".$idmotor." motor:MemilikiTingkatKonsumsiBahanBakar ?konsumsi. motor:".$idmotor." motor:MemilikiKecepatan ?kecepatan. motor:".$idmotor." motor:MemilikiKapasitasBahanBakar ?kapasitas. motor:".$idmotor." motor:MemilikiDimensiLebar ?L. motor:".$idmotor." motor:MemilikiDimensiTinggi ?T. motor:".$idmotor." motor:MemilikiDimensiPanjang ?P. motor:".$idmotor." motor:MemilikiHarga ?harga}";
        $hasil = $sparql->query($sql);
          foreach($hasil as $item){
            $transmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->t->getUri());
            $merek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->m->getUri());
            $sistem = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->sb->getUri());
            $jenis = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->j->getUri());
            $volume = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->v->getUri());
            $tahun = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->tp->getUri());
            $konsumsi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->konsumsi->getValue());
            $kecepatan = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->kecepatan->getValue());
            $kapasitas = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->kapasitas->getValue());
            $lebar = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->L->getValue());
            $tinggi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->T->getValue());
            $panjang = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->P->getValue());
            $harga = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->harga->getValue());
        ?>
        <div class="container">
          <div class="row">
            <div class="col-4">
              <img src="/images/motor/cbr150r.jpg" class="img-thumbnail rounded"> 
            </div>
            <div class="col-4">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>{{ $merek }}</td>
                  </tr>
                  <tr>
                    <td>Tahun Produksi</td>
                    <td>:</td>
                    <td>{{ $tahun }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Transmisi</td>
                    <td>:</td>
                    <td>{{ $transmisi }}</td>
                  </tr>
                  <tr>
                    <td>Type</td>
                    <td>:</td>
                    <td>{{ $jenis }}</td>
                  </tr>
                  <tr>
                    <td>Sistem Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $sistem }}</td>
                  </tr>
                  <tr>
                    <td>Volume Silinder</td>
                    <td>:</td>
                    <td>{{ $volume }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-4">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Konsumsi Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $konsumsi }} L/km</td>
                  </tr>
                  <tr>
                    <td>Kecepatan</td>
                    <td>:</td>
                    <td>{{ $kecepatan }} km/j</td>
                  </tr>
                  <tr>
                    <td>Kapasitas Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $kapasitas }} L</td>
                  </tr>
                  <tr>
                    <td>Dimensi</td>
                    <td>:</td>
                    <td>{{ $panjang }} x {{ $tinggi }} x {{ $lebar }} mm</td>
                  </tr>
                  <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>Rp. {{ $harga }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
    </section>
    <!-- /.content -->
  </div>
@endsection