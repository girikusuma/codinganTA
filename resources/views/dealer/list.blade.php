@extends('layout/main')

@section('title', 'Dealer Sepeda Motor')

@section('container')
<div class="content-wrapper">
  <div class="row">
    <div class="col">
      <div class="content-header">
        <h1 class="m-0 text-dark">Daftar Dealer Motor</h1>
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
              @foreach($getDealer as $item)
                @if($item['merekDealer'] == $count['merek'])
                <a href="{{ route('dealer.detail', [$provinsi, $kabupaten, $item['id']]) }}" class="text-decoration-none text-muted">
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