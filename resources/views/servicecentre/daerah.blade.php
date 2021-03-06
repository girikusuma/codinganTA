@extends('layout/main')

@section('title', 'Service Centre')

@section('container')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($kabupaten as $item)
            <div class="col-lg-3  mt-4">
              <div class="small-box bg-ligth">
                <div class="inner">
                  <h3 style="font-size:2.2vw;">{{ $item['namaKabupaten'] }}</h3>
                  <p>Jumlah : {{ $item['jumlah'] }}</p>
                </div>
                <a href="{{ route('service.show', [$provinsi, $item['namaKabupaten']]) }}" class="small-box-footer" style="color: black;">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection