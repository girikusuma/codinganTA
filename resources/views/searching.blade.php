<?php
require_once '../vendor/autoload.php';

use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');
$sparql = new Client('http://127.0.0.1:3030/motor/query');
$merek = $sparql->query('SELECT * WHERE {?merek rdf:type motor:MerkMotor}');
$transmisi = $sparql->query('SELECT * WHERE {?transmisi rdf:type motor:Transmisi}');
$typemotor = $sparql->query('SELECT * WHERE {?typemotor rdf:type motor:JenisMotor}');
$tahun = $sparql->query('SELECT * WHERE {?tahun rdf:type motor:TahunProduksi}');
$volume = $sparql->query('SELECT * WHERE {?volume rdf:type motor:VolumeSilinder}');
?>
@extends('layout/main')

@section('title', 'Searching')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Searching</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="kosong">Pilih...</option>
                <?php
                foreach($merek as $m){
                    $namamerek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$m->merek->getUri());
                ?>
                <option value="$namamerek">{{ $namamerek }}</option>
                <?php }?>
            </select>
        </div>
        <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="kosong">Pilih...</option>
                <?php
                foreach($transmisi as $t){
                    $namatransmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$t->transmisi->getUri());
                ?>
                <option value="$namatransmisi">{{ $namatransmisi }}</option>
                <?php }?>
            </select>
        </div>
        <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="kosong">Pilih...</option>
                <?php
                foreach($typemotor as $ty){
                    $namatype = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$ty->typemotor->getUri());
                ?>
                <option value="$namatype">{{ $namatype }}</option>
                <?php }?>
            </select>
        </div>
        <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="kosong">Pilih...</option>
                <?php
                foreach($tahun as $th){
                    $tahunproduksi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$th->tahun->getUri());
                ?>
                <option value="$tahunproduksi">{{ $tahunproduksi }}</option>
                <?php }?>
            </select>
        </div>
        <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
        <div class="input-group mb-3">
            <select class="custom-select" id="inputGroupSelect01">
                <option value="kosong">Pilih...</option>
                <?php
                foreach($volume as $v){
                    $volumesilinder = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$v->volume->getUri());
                ?>
                <option value="$volumesilinder">{{ $volumesilinder }}</option>
                <?php }?>
            </select>
        </div>
        <button type="button" class="btn btn-primary">Cari</button>
        <button type="button" class="btn btn-danger">Reset</button>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection