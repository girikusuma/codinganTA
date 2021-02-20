@extends('layout/main')

@section('title', 'Browsing')

@section('container')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Browsing</h1>
        </div>
      </div>
    </div>
  </div>
  <section class="content mt-n4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3  mt-4">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Daftar Motor</h3>
              <p>Jumlah : {{ $data['jumlahMotor'] }}</p>
            </div>
            <a href="{{ route('listmotor.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3  mt-4">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Merek</h3>
              <p>Jumlah : {{ $data['jumlahMerek'] }}</p>
            </div>
            <a href="{{ route('listmerek.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 mt-4">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Jenis Transmisi</h3>
              <p>Jumlah : {{ $data['jumlahTransmisi'] }}</p>
            </div>
            <a href="{{ route('listtransmisi.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 mt-4">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Type Motor</h3>
              <p>Jumlah : {{ $data['jumlahType'] }}</p>
            </div>
            <a href="{{ route('listtype.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 mt-4">
          <div class="small-box bg-ligth">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Tahun Produksi</h3>
              <p>Jumlah : {{ $data['jumlahTahun'] }}</p>
            </div>
            <a href="{{ route('listtahun.index') }}" class="small-box-footer" style="color: black;">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 mt-4">  
          <div class="small-box bg-dark">
            <div class="inner">
              <h3 style="font-size:2.2vw;">Volume Silinder</h3>
              <p>Jumlah : {{ $data['jumlahVolume'] }}</p>
            </div>
            <a href="{{ route('listvolume.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection