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
        <form action="" method="GET">
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="merek" name="merek">
                  <option value="kosong">Pilih...</option>
                  <?php
                  foreach($merek as $m){
                      $namamerek = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$m->merek->getUri());
                  ?>
                  <option value="<?php echo $namamerek ?>">{{ $namamerek }}</option>
                  <?php }?>
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="transmisi" name="transmisi">
                  <option value="kosong">Pilih...</option>
                  <?php
                  foreach($transmisi as $t){
                      $namatransmisi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$t->transmisi->getUri());
                  ?>
                  <option value="<?php echo $namatransmisi ?>">{{ $namatransmisi }}</option>
                  <?php }?>
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="typemotor" name="typemotor">
                  <option value="kosong">Pilih...</option>
                  <?php
                  foreach($typemotor as $ty){
                      $namatype = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$ty->typemotor->getUri());
                  ?>
                  <option value="<?php echo $namatype ?>">{{ $namatype }}</option>
                  <?php }?>
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="tahun" name="tahun">
                  <option value="kosong">Pilih...</option>
                  <?php
                  foreach($tahun as $th){
                      $tahunproduksi = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$th->tahun->getUri());
                  ?>
                  <option value="<?php echo $tahunproduksi ?>">{{ $tahunproduksi }}</option>
                  <?php }?>
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="volume" name="volume">
                  <option value="kosong">Pilih...</option>
                  <?php
                  foreach($volume as $v){
                      $volumesilinder = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$v->volume->getUri());
                  ?>
                  <option value="<?php echo $volumesilinder ?>">{{ $volumesilinder }}</option>
                  <?php }?>
              </select>
          </div>
          <input type="submit" name="cari" value="Cari" class="btn btn-primary">
          <input type="submit" name="reset" value="Reset" class="btn btn-danger">
        </form>
        <?php
        if (isset($_GET['cari']))
        {
          $hasilmerek = $_GET['merek'];
          $hasiltransmisi = $_GET['transmisi'];
          $hasiltypemotor = $_GET['typemotor'];
          $hasiltahun = $_GET['tahun'];
          $hasilvolume = $_GET['volume'];
          if($hasilmerek == 'kosong'){
            $hasilmerek = '?merek';
          } else {
            $hasilmerek = 'motor:'.$hasilmerek;
          }
          if($hasiltransmisi == 'kosong'){
            $hasiltransmisi = '?transmisi';
          } else {
            $hasiltransmisi = 'motor:'.$hasiltransmisi;
          }
          if($hasiltypemotor == 'kosong'){
            $hasiltypemotor = '?typemotor';
          } else {
            $hasiltypemotor = 'motor:'.$hasiltypemotor;
          }
          if($hasiltahun == 'kosong'){
            $hasiltahun = '?tahun';
          } else {
            $hasiltahun = 'motor:'.$hasiltahun;
          }
          if($hasilvolume == 'kosong'){
            $hasilvolume = '?volume';
          } else {
            $hasilvolume = 'motor:'.$hasilvolume;
          }

          $querydata = $sparql->query("SELECT * WHERE {?motor motor:AdalahMerkDari ".$hasilmerek.". ?motor motor:AdalahJenisTransmisi ".$hasiltransmisi.". ?motor motor:MemilikiTahunProduksi ".$hasiltahun.". ?motor motor:MemilikiJenis ".$hasiltypemotor.". ?motor motor:MemilikiVolumeSilinder ".$hasilvolume.". ?motor motor:MemilikiNama ?nama}")
        ?>
        <div class="container-fluid">
          <div class="text-nowrap font-weight-bold mt-3"><h2>Hasil</h2></div>
          <table class="table mt-3">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Motor</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($querydata as $item){
                $hasilmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->nama->getValue());
              ?>
              <tr>
                <th scope="row">1</th>
                <td>{{ $hasilmotor }}</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <?php } ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection