@extends('layout/main')

@section('title', 'Service Centre Sepeda Motor')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Daftar Service Centre Motor</h1>
        <hr>
      </div>
      <section class="content">
      <div class="container">
        <div class="row">
          @foreach($getMerek as $item)
            <div class="col">
              <h4>{{ $item['merek'] }}</h4>
            </div>
          @endforeach
        </div>
      </div>
      <div class="container">
        <div class="row">
          @foreach($getMerek as $count)
            <div class="col">
              @foreach($getService as $item)
                @if($item['merekService'] == $count['merek'])
                  <a href="{{ route('service.detail', [$provinsi, $kabupaten, $item['id']]) }}" class="text-decoration-none text-muted">
                    <p>{{ $item['id'] }}</p>
                  </a>
                @endif
              @endforeach
            </div>
          @endforeach
        </div>
      </div>
      </section>
    </div>
  </div>
</div>
@endsection