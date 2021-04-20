@extends('layout/main')

@section('title', 'Merek Sepeda Motor')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Merek Motor</h1>
        <hr>
      </div>
      <section class="content">
        <div class="row">
          @foreach($merek as $item)
          <div class="col col-lg-3">
            <a href="{{ route('listmerek.show', [$item['namamerek']]) }}" style="color: black;">
              <div class="card text-white bg-dark ml-2" style="width: 18rem;">
                <img src="/images/merek/{{ $item['gambar'] }}" class="card-img-top" style="height : 12rem; width : 17.9rem;">
                <div class="card-body">
                  <h5 class="card-title">{{ $item['nama'] }}</h5>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </section>
    </div>
  </div>
</div>
@endsection