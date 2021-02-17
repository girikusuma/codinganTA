@extends('layout/main')

@section('title', 'List Sepeda Motor')

@section('container')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="content-header">
          <h1 class="m-0 text-dark">Sepeda Motor</h1>
          <div class="divider"></div>
        </div>
        <section class="content">
          <div class="row">
            @foreach($motor as $item)
              <div class="card ml-4" style="width: 18rem;">
                <img src="/images/motor/{{ $item['gambar'] }}" class="card-img-top" style="height : 12rem; width : 17.9rem;">
                <a href="{{ route('listmotor.show', [$item['idmotor']]) }}" style="color: black;">
                  <div class="card-body">
                    <h5 class="card-title">{{ $item['hasilmotor'] }}</h5>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
@endsection