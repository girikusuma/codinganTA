@extends('layout/main')

@section('title', 'Dealer')

@section('container')

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($hasilprovinsi as $item)
            <div class="col-lg-3 col  mt-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 style="font-size:2.2vw;">{{{ $item['provinsi'] }}}</h3>
                </div>
                <a href="{{ route('dealer.location', [$item['provinsi']]) }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
@endsection