@extends('layout/main')

@section('title', 'List Sepeda Motor dengan Tahun Produksi {{ $tahun }}')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor dengan Tahun Produksi {{ $tahun }}</h1>
        <hr>
      </div>
      <section class="content">
        @if($jumlah > 0)
          @foreach($motor as $item)
            <a href="{{ url('/listmotor/'.$item['id'].'/') }}" style="color: black;">
              <div class="card d-inline-block mr-2" style="width: 18rem;">
                <div class="card-body">
                  <p class="font-weight-normal ml-3">{{ $item['nama'] }}</p>
                </div>
              </div>
            </a>
          @endforeach
        @else
          <p class="font-weight-normal ml-3">Tidak ada data Sepeda Motor dengan Tahun Produksi {{ $tahun }}</p>
        @endif
      </section>
    </div>
  </div>
</div>
@endsection