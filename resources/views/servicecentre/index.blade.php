<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$provinsi = $sparql->query('SELECT * WHERE {?s rdf:type motor:Provinsi}');
?>
@extends('layout/main')

@section('title', 'Service Centre')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <?php
          foreach($provinsi as $item){
            $hasilprovinsi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());
        ?>
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{{ $hasilprovinsi }}}</h3>
              </div>
              <a href="{{ url('/servicecentre/'.$hasilprovinsi.'/') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <?php
          }
        ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection