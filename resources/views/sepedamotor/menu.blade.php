@extends('layout/main')

@section('title', 'Browsing')

@section('container')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Daftar Motor</h3>
                <p>Jumlah : {{ $data['jumlahMotor'] }}</p>
              </div>
              <a href="{{ url('/listmotor') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6  mt-4 ml-2">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Merek</h3>
                <p>Jumlah : {{ $data['jumlahMerek'] }}</p>
              </div>
              <a href="{{ url('/listmerek') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6 mt-4 ml-2">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Jenis Transmisi</h3>
                <p>Jumlah : {{ $data['jumlahTransmisi'] }}</p>
              </div>
              <a href="{{ url('/listtransmisi') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6 mt-4 ml-2">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Type Motor</h3>
                <p>Jumlah : {{ $data['jumlahType'] }}</p>
              </div>
              <a href="{{ url('/listtype') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6 mt-4 ml-2">
            <div class="small-box bg-ligth">
              <div class="inner">
                <h3>Tahun Produksi</h3>
                <p>Jumlah : {{ $data['jumlahTahun'] }}</p>
              </div>
              <a href="{{ url('/listtahun') }}" class="small-box-footer" style="color: black;">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6 mt-4 ml-2">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Volume Silinder</h3>
                <p>Jumlah : {{ $data['jumlahVolume'] }}</p>
              </div>
              <a href="{{ url('/listvolumesilinder') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection