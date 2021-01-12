<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$motor = $sparql->query('SELECT * WHERE {?s rdf:type motor:NamaUnit. ?s motor:MemilikiNama ?o}');
$merek = $sparql->query('SELECT * WHERE {?s rdf:type motor:MerkMotor}');
$transmisi = $sparql->query('SELECT * WHERE {?s rdf:type motor:Transmisi}');
?>
@extends('layout/main')

@section('title', 'Browsing')

@section('container')

<?php
    $i = 0;
    $j = 0;
    $k = 0;
    foreach ($motor as $item){
        $i = $i + 1;
    }
    foreach ($merek as $mrk){
        $j = $j + 1;
    }
    foreach ($transmisi as $tr){
        $k = $k + 1;
    }
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Daftar Motor</h3>
                <p>Jumlah : {{ $i }}</p>
              </div>
              <a href="{{ url('/listmotor') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Merek</h3>
                <p>Jumlah : {{ $j }}</p>
              </div>
              <a href="{{ url('/listmerek') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 mt-4 ml-2">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Jenis Transmisi</h3>
                <p>Jumlah : {{ $k }}</p>
              </div>
              <a href="{{ url('/listtransmisi') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection