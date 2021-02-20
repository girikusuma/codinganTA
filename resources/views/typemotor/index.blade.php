@extends('layout/main')

@section('title', 'Type Sepeda Motor')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Type Sepeda Motor</h1>
        <hr>
      </div>
      <section class="content">
        <div class="row">
          @foreach($hasiltype as $item)
          <div class="col col-lg-3">
            <a href="{{ route('listtype.show', [$item['type']]) }}" style="color: black;">
              <div class="card d-inline-block mr-2 text-white bg-dark mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title">{{ $item['type'] }}</h3>
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