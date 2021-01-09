<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');

$motor = $sparql->query("SELECT * WHERE {?s rdf:type motor:NamaUnit. ?s motor:MemilikiNama ?o}");
$merek = $sparql->query("SELECT * WHERE {?s rdf:type motor:MerkMotor}");
$transmisi = $sparql->query("SELECT * WHERE {?s rdf:type motor:Transmisi}");
$tahun = $sparql->query("SELECT * WHERE {?s rdf:type motor:TahunProduksi}");
$type = $sparql->query("SELECT * WHERE {?s rdf:type motor:JenisMotor}");
?>
@extends('layout/main')

@section('title', 'Browsing')

@section('container')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor</h1>
      </div>
      <section class="content">
        <?php
          foreach($motor as $item){
            $hasilmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->o->getValue());
        ?>
        <a href="#" style="color: black;"><p class="font-weight-normal ml-3"><?php echo $hasilmotor ?></p></a>
        <?php
        }
        ?>
      </section>
    </div>
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Merek Motor</h1>
      </div>
      <section class="content">
        <?php
          foreach($merek as $item){
            $hasilmerek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
        <a href="#" style="color: black;"><p class="font-weight-normal ml-3"><?php echo $hasilmerek ?></p></a>
        <?php
        }
        ?>
      </section>
    </div>
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Jenis Transmisi</h1>
      </div>
      <section class="content">
        <?php
          foreach($transmisi as $item){
            $hasiltransmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
        <a href="#" style="color: black;"><p class="font-weight-normal ml-3"><?php echo $hasiltransmisi ?></p></a>
        <?php
        }
        ?>
      </section>
    </div>
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Tahun Produksi</h1>
      </div>
      <section class="content">
        <?php
          foreach($tahun as $item){
            $hasiltahun = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
        <a href="#" style="color: black;"><p class="font-weight-normal ml-3"><?php echo $hasiltahun ?></p></a>
        <?php
        }
        ?>
      </section>
    </div>
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Type Motor</h1>
      </div>
      <section class="content">
        <?php
          foreach($type as $item){
            $hasiltype = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
        <a href="#" style="color: black;"><p class="font-weight-normal ml-3"><?php echo $hasiltype ?></p></a>
        <?php
        }
        ?>
      </section>
    </div>
  </div>
</div>
@endsection