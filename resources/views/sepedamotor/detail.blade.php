<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$mtr = 'Mio_Z';
?>
@extends('layout/main')

@section('title', 'Browsing')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $mtr ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <?php
        $sql = "SELECT * WHERE {motor:".$mtr." motor:AdalahJenisTransmisi ?o. motor:".$mtr." motor:AdalahMerkDari ?m}";
        $hasil = $sparql->query($sql);
          foreach($hasil as $item){
            $transmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->o->getUri());
            $merek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->m->getUri());
        ?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $transmisi ?></h5>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $merek ?></h5>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
    <!-- /.content -->
  </div>
@endsection