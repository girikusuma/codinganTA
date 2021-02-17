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
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 style="font-size:2.5vw;">Sepeda Motor</h3>
              <p>I Made Cantiawan Giri Kusuma</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-bicycle"></i>
            </div>
            <a href="{{ route('sepedamotor') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 style="font-size:2.5vw;">Dealer</h3>
              <p>I Made Cantiawan Giri Kusuma</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="{{ route('dealer.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 style="font-size:2.5vw;">Service Centre</h3>
              <p>I Made Cantiawan Giri Kusuma</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cog"></i>
            </div>
            <a href="{{ route('service.index') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection