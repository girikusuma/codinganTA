@extends('layout/main')

@section('title', 'List Sepeda Motor')

@section('container')
<div class="content-wrapper">
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Sepeda Motor</h1>
        <hr>
      </div>
      <section class="content">
        @foreach($motor as $item)
          <a href="{{ url('/listmotor/'.$item['idmotor'].'/') }}" style="color: black;">
            <div class="card d-inline-block mr-2" style="width: 18rem;">
              <div class="card-body">
                <p class="font-weight-normal ml-3">{{ $item['hasilmotor'] }}</p>
              </div>
            </div>
          </a>
        @endforeach
      </section>
    </div>
  </div>
</div>
@endsection