@extends('layout/main')

@section('title', 'Service Centre')

@section('container')

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @foreach($hasilprovinsi as $item)
            <div class="col-lg-3 col-6  mt-4 ml-2">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{{ $item['provinsi'] }}}</h3>
                </div>
                <a href="{{ url('/servicecentre/'.$item['provinsi'].'/') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endforeach
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection