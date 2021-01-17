<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$provinsi = $prov;
$kabupaten = $kab;
$merek = $sparql->query('SELECT * WHERE {?merek rdf:type motor:MerkMotor}');

?>
@extends('layout/main')

@section('title', 'Dealer Sepeda Motor')

@section('container')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Daftar Dealer Motor</h1>
        <hr>
      </div>
      <section class="content">
      <div class="container">
        <div class="row">
          <?php
          $merekarray = array();
          $m = 0;
          foreach($merek as $mr){
            $merekarray[$m] = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$mr->merek->getUri());
            $namamerek = $merekarray[$m];
            $m = $m + 1;
          ?>
          <div class="col">
            <h4>{{ $namamerek }}</h4>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <?php
            $n = 0;
            for($n = 0; $n < $m; $n++){
          ?>
          <div class="col">
            <?php
              $merekdealer = $merekarray[$n];
              $dealer = $sparql->query('SELECT * WHERE {?s rdf:type motor:NamaDealer. ?s motor:MemilikiLokasi motor:'.$kabupaten.'. ?s motor:AdalahDealerDari motor:'.$merekdealer.'}');
              foreach($dealer as $dl){
                $iddealer = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$dl->s->getUri());
            ?>
            <a href="{{ url('/dealer/'.$provinsi.'/'.$kabupaten.'/'.$iddealer.'/') }}" class="text-decoration-none text-muted">
              <p>{{ $iddealer }}</p>
            </a>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
      </div>
      </section>
    </div>
  </div>
</div>
@endsection