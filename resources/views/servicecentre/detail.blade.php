@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ $id }}</h1>
          </div>
        </div>
    </div>
  </div>
  <section class="content">
    <div class="row">
      <div class="col">
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
  </section>
</div>
@endsection