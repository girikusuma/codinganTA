<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');

$qr = "SELECT * WHERE {?s motor:MemilikiTahunProduksi motor:".$tahun.". ?s motor:MemilikiNama ?n}";
$getnama = $sparql->query($qr);

?>
@extends('layout/main')

@section('title', 'List Sepeda Motor dengan Tahun Produksi {{ $tahun }}')

@section('container')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor dengan Tahun Produksi {{ $tahun }}</h1>
        <hr>
      </div>
      <section class="content">
        <?php
          $i = 0;
          foreach($getnama as $item){
            $nama = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->n->getValue());
            $idmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
            $i = $i + 1;
        ?>
        <a href="{{ url('/listmotor/'.$idmotor.'/') }}" style="color: black;">
          <div class="card d-inline-block mr-2" style="width: 18rem;">
            <div class="card-body">
              <p class="font-weight-normal ml-3">{{ $nama }}</p>
            </div>
          </div>
        </a>
        <?php
        }
        if ($i == "0") {
            echo "Tidak ada data Sepeda Motor dengan Tahun Produksi ".$tahun;
          }
        ?>
      </section>
    </div>
  </div>
</div>
@endsection