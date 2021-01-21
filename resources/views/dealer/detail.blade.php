@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $id }}</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col">
            <table class="table table-striped">
              <tbody>
                @foreach($dealer as $item)
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>{{ $item['merek'] }}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jl. Teuku Umar No.52-54, Dauh Puri Kauh, Kec. Denpasar Bar., Kota Denpasar, Bali 80114</td>
                  </tr>
                  <tr>
                    <td>Jam Buka</td>
                    <td>:</td>
                    <td>07:30 WITA</td>
                  </tr>
                  <tr>
                    <td>Jam Tutup</td>
                    <td>:</td>
                    <td>21:00 WITA</td>
                  </tr>
                    <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td>(0361) 242002</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection