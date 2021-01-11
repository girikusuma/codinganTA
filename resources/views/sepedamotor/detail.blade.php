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
        $sql = "SELECT * WHERE {motor:".$idmotor." motor:AdalahJenisTransmisi ?t. motor:".$idmotor." motor:AdalahMerkDari ?m. motor:".$idmotor." motor:MemilikiSistemBahanBakar ?sb. motor:".$idmotor." motor:MemilikiJenis ?j. motor:".$idmotor." motor:MemilikiVolumeSilinder ?v . motor:".$idmotor." motor:MemilikiTahunProduksi ?tp}";
        $hasil = $sparql->query($sql);
          foreach($hasil as $item){
            $transmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->t->getUri());
            $merek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->m->getUri());
            $sistem = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->sb->getUri());
            $jenis = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->j->getUri());
            $volume = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->v->getUri());
            $tahun = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->tp->getUri());
        ?>
        <div class="container">
          <div class="row">
            <div class="col-4">
              1 of 2
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
          </div>
        </div>
        <?php
        }
        ?>
    </section>
    <!-- /.content -->
  </div>
@endsection