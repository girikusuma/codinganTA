@extends('layout/main')

@section('title', 'Dealer')

@section('container')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($hasilprovinsi as $item)
            <div class="col-lg-3 col-6  mt-4 ml-2">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{{ $item['provinsi'] }}}</h3>
                </div>
                <a href="{{ url('/dealer/'.$item['provinsi'].'/') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection