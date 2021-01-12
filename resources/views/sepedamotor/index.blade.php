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

?>
@extends('layout/main')

@section('title', 'List Sepeda Motor')

@section('container')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor</h1>
        <hr>
      </div>
      <section class="content">
        <?php
          foreach($motor as $item){
            $hasilmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->o->getValue());
            $idmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
        <a href="{{ url('/listmotor/'.$idmotor.'/') }}" style="color: black;">
          <div class="card d-inline-block mr-2" style="width: 18rem;">
            <div class="card-body">
              <p class="font-weight-normal ml-3">{{ $hasilmotor }}</p>
            </div>
          </div>
        </a>
        <?php
        }
        ?>
      </section>
    </div>
  </div>
</div>
@endsection