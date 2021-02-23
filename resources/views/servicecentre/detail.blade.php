@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          @if($jumlah > 0)
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ $id }}</h1>
          </div>
          @endif
        </div>
    </div>
  </div>
  <section class="content">
    @if($jumlah > 0)
    <div class="row">
      <div class="col-lg-4">
        <div class="card" style="width: auto;">
          <div class="card-body">
            <img class="card-img-top" src="/images/browsingcard.jpg" alt="Card image cap"> 
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header text-bold">Tentang Service Centre</div>
          <div class="card-body">
            <table class="table table-striped">
              <tbody>
                @foreach($service as $item)
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>{{ $item['merek'] }}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $item['alamat'] }}</td>
                  </tr>
                  <tr>
                    <td>Jam Buka</td>
                    <td>:</td>
                    <td>{{ $item['jamBuka'] }} WITA</td>
                  </tr>
                  <tr>
                    <td>Jam Tutup</td>
                    <td>:</td>
                    <td>{{ $item['jamTutup'] }} WITA</td>
                  </tr>
                    <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>{{ $item['noTelp'] }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="card text-white bg-danger mb-3 mt-1">
      <div class="card-body">
        <p class="card-text">Data service center belum ada.</p>
      </div>
    </div>
    @endif
  </section>
</div>
@endsection