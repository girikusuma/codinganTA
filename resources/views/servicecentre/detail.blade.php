<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
?>
@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $service }}</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <?php
        $sql = "SELECT * WHERE {motor:".$service." motor:AdalahDealerDari ?merek}";
        $hasil = $sparql->query($sql);
          foreach($hasil as $item){
            $merek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->merek->getUri());
        ?>
        <div class="container">
          <div class="row">
            <div class="col">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>{{ $merek }}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Teuku Umar No.52-54, Dauh Puri Kauh, Kec. Denpasar Bar., Kota Denpasar, Bali 80114</td>
                  </tr>
                  <tr>
                    <td>Jam Buka</td>
                    <td>:</td>
                    <td>07:30 WITA</td>
                  </tr>
                  <tr>
                    <td>Jam Tutup</td>
                    <td>:</td>
                    <td>21:00 WITA</td>
                  </tr>
                  <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>(0361) 242002</td>
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