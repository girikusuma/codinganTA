@extends('layout/main')

@section('title', 'Dealer Sepeda Motor')

@section('container')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="content-header">
          <h1 class="m-0 text-dark">Daftar Dealer Motor</h1>
          <hr>
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              @foreach($getMerek as $item)
              <div class="col col-lg-3">
                <h4>{{ $item['merek'] }}</h4>
                @foreach($getDealer as $key)
                  @if($item['merek'] == $key['merekDealer'])
                  <a href="{{ route('dealer.detail', [$key['id']]) }}" class="text-decoration-none text-muted">
                    <p>{{ $key['id'] }}</p>
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
</div>
@endsection