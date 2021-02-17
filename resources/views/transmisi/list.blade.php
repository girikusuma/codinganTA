@extends('layout/main')

@section('title', 'List Sepeda Motor dengan Transmisi')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor dengan Transmisi {{ $transmisi }}</h1>
        <hr>
      </div>
      <section class="content">
        @if($jumlah > 0)
          <div class="row">
            @foreach($motor as $item)
              <div class="card ml-4" style="width: 18rem;">
                <img src="/images/motor/{{ $item['gambar'] }}" class="card-img-top" style="height : 12rem; width : 17.9rem;">
                <a href="{{ route('listmotor.show', [$item['id']]) }}" style="color: black;">
                  <div class="card-body">
                    <h5 class="card-title">{{ $item['nama'] }}</h5>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @else
          <p class="font-weight-normal ml-3">Tidak ada data Sepeda Motor dengan Transmisi {{ $transmisi }}</p>
        @endif
      </section>
    </div>
  </div>
</div>
@endsection