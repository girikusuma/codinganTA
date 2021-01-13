<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$kabupaten = $sparql->query('SELECT * WHERE {?s motor:AdalahBagianDari motor:'.$daerah.'}');
?>
@extends('layout/main')

@section('title', 'Dealer')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <?php
            foreach ($kabupaten as $item){
                $namakabupaten = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->s->getUri());

                $query = $sparql->query('SELECT * WHERE {?s motor:MemilikiLokasi motor:'.$namakabupaten.'. ?s rdf:type motor:NamaDealer}');
                $jumlah = 0;
                foreach ($query as $it){
                    $jumlah = $jumlah + 1;
                }
        ?>
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <!-- small box -->
            <div class="small-box bg-ligth">
              <div class="inner">
                <h3>{{ $namakabupaten }}</h3>
                <p>Jumlah : {{ $jumlah }}</p>
              </div>
              <a href="{{ url('/dealer/'.$daerah.'/'.$namakabupaten.'/') }}" class="small-box-footer" style="color: black;">Lihat <i class="fas fa-arrow-circle-right"></i></a>
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