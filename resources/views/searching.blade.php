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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Searching</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <form action="" method="GET">
          <div class="row">
              <div class="col">
                <div class="form-group">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_merek" name="cari_merek">
                          <option value="semua">Pilih...</option>
                          @foreach($getMerek as $item)
                            <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_transmisi" name="cari_transmisi">
                          <option value="semua">Pilih...</option>
                          @foreach($getTransmisi as $item)
                            <option value="{{ $item['hasilTransmisi'] }}">{{ $item['hasilTransmisi'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_typemotor" name="cari_typemotor">
                          <option value="semua">Pilih...</option>
                          @foreach($getType as $item)
                            <option value="{{ $item['hasilType'] }}">{{ $item['hasilType'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_tahun" name="cari_tahun">
                          <option value="semua">Pilih...</option>
                          @foreach($getTahun as $item)
                            <option value="{{ $item['hasilTahun'] }}">{{ $item['hasilTahun'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_volume" name="cari_volume">
                          <option value="semua">Pilih...</option>
                          @foreach($getVolume as $item)
                            <option value="{{ $item['hasilVolume'] }}">{{ $item['hasilVolume'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            <div class="col mt-4">
              <input type="submit" name="cari" value="Cari" class="btn btn-primary">
              <input type="submit" name="reset" value="Reset" class="btn btn-danger" onclick="resetPage()">
            </div>
          </div>
        </form>
      </div>
        <?php
        if (isset($_GET['cari']))
        {
          $hasilmerek = $_GET['cari_merek'];
          $hasiltransmisi = $_GET['cari_transmisi'];
          $hasiltypemotor = $_GET['cari_typemotor'];
          $hasiltahun = $_GET['cari_tahun'];
          $hasilvolume = $_GET['cari_volume'];
          
          $sql = "SELECT * WHERE {?motor rdf:type motor:NamaUnit";

          if($hasilmerek != 'semua'){
              $sql = $sql.". ?motor motor:AdalahMerkDari motor:".$hasilmerek;
          }
          if($hasiltransmisi != 'semua'){
              $sql = $sql.". ?motor motor:AdalahJenisTransmisi motor:".$hasiltransmisi;
          }
          if($hasiltypemotor != 'semua'){
              $sql = $sql.". ?motor motor:MemilikiJenis motor:".$hasiltypemotor;
          }
          if($hasiltahun != 'semua'){
              $sql = $sql.". ?motor motor:MemilikiTahunProduksi motor:".$hasiltahun;
          }
          if($hasilvolume != 'semua'){
              $sql = $sql.". ?motor motor:MemilikiVolumeSilinder motor:".$hasilvolume;
          }

          $sql = $sql.". ?motor motor:MemilikiNama ?nama}";

          $querydata = $sparql->query($sql);

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
          <div class="text-nowrap font-weight-bold mt-3"><h2>Hasil Pencarian</h2></div>
            <div class="row">
              <div class="col">
                <div class="card border-warning mb-3">
                  <div class="card-header">Sepeda Motor</div>
                  <div class="card-body text-decoration-none">
                    <table class="table mt-n2 table-sm">
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
                </div>
              </div>
              <div class="col">
                <div class="card text-white bg-info mb-3">
                  <div class="card-header">SPARQL QUERY</div>
                  <div class="card-body">
                    <p class="card-text">{{ $sql }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } 
        if (isset($_GET['reset']))
        {
        ?>
        <h5>Silahkan pilih kriteria sepeda motor untuk melakukan pencarian</h5>
        <?php } ?>
      </div>
    </section>
  </div>
@endsection
@section('js')
<script>
  function resetPage(){
    location.reload();
  }
</script>
@endsection