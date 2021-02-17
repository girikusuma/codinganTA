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
      @foreach($merek as $item)
        <a href="{{ route('listmerek.show', [$item['namamerek']]) }}" style="color: black;">
          <div class="card d-inline-block mr-2 text-white bg-dark mb-3" style="width: 18rem;">
            <div class="card-body">
                <h3 class="card-title">{{ $item['namamerek'] }}</h3>
            </div>
          </div>
        </a>
        @endforeach
      </section>
    </div>
  </div>
</div>
@endsection