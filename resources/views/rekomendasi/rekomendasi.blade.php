<?php
use EasyRdf\RdfNamespace;
use EasyRdf\Sparql\Client;

RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
RdfNamespace::set('motor', 'http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#');

$sparql = new Client('http://127.0.0.1:3030/motor/query');
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
                  @foreach($getMerek as $item)
                    <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="transmisi" name="transmisi">
                  <option value="kosong">Pilih...</option>
                  @foreach($getTransmisi as $item)
                    <option value="{{ $item['hasilTransmisi'] }}">{{ $item['hasilTransmisi'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="typemotor" name="typemotor">
                  <option value="kosong">Pilih...</option>
                  @foreach($getType as $item)
                    <option value="{{ $item['hasilType'] }}">{{ $item['hasilType'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="tahun" name="tahun">
                  <option value="kosong">Pilih...</option>
                  @foreach($getTahun as $item)
                    <option value="{{ $item['hasilTahun'] }}">{{ $item['hasilTahun'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="volume" name="volume">
                  <option value="kosong">Pilih...</option>
                  @foreach($getVolume as $item)
                    <option value="{{ $item['hasilVolume'] }}">{{ $item['hasilVolume'] }}</option>
                  @endforeach
              </select>
          </div>
          <input type="submit" name="cari" value="Cari" class="btn btn-primary">
          <input type="submit" name="reset" value="Reset" class="btn btn-danger" onclick="resetPage()">
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

          $querydata = $sparql->query("SELECT * WHERE {?motor motor:AdalahMerkDari ".$hasilmerek.". ?motor motor:AdalahJenisTransmisi ".$hasiltransmisi.". ?motor motor:MemilikiTahunProduksi ".$hasiltahun.". ?motor motor:MemilikiJenis ".$hasiltypemotor.". ?motor motor:MemilikiVolumeSilinder ".$hasilvolume.". ?motor motor:MemilikiNama ?nama}");
          $jumlah = 0;
          foreach($querydata as $getjumlah){
            $jumlah = $jumlah + 1;
          }
          $arraymotor = array();
          $arrayid = array();
          $iterasimotor = 0;
          foreach($querydata as $item){
            $idmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->motor->getUri());
            $hasilmotor = str_replace('http://www.semanticweb.org/girikusuma/OntologiSepedaMotor#','',$item->nama->getValue());
            $arraymotor[$iterasimotor] = $hasilmotor;
            $arrayid[$iterasimotor] = $idmotor;
            $iterasimotor = $iterasimotor + 1;
          }
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
              $iteration = 0;
              if($jumlah > 0){
                for($motor = 1; $motor <= $jumlah; $motor++){
                  if($motor < $jumlah){
                    if($arraymotor[$motor - 1] != $arraymotor[$motor]){
                      $iteration = $iteration + 1;
                      $id = $arrayid[$motor - 1];
              ?>
              <tr>
                <th scope="row">{{ $iteration }}</th>
                <td><a href="{{ url('/listmotor/'.$id.'/') }}" class="text-decoration-none text-muted"><?php echo $arraymotor[$motor - 1]; ?></a></td>
              </tr>
              <?php
                    }
                  } else { $iteration = $iteration + 1; $id = $arrayid[$motor - 1]; ?>
              <tr>
                <th scope="row">{{ $iteration }}</th>
                <td><a href="{{ url('/listmotor/'.$id.'/') }}" class="text-decoration-none text-muted"><?php echo $arraymotor[$motor - 1]; ?></a></td>
              </tr>
              <?php
                  }
                } 
              } else { ?>
              <tr>
                <th scope="row"></th>
                <td>Data sepeda motor dengan kriteria tersebut tidak ada.</td>
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
<script>
  function resetPage(){
    location.reload();
  }
</script>
@endsection