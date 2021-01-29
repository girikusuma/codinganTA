@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $nama }}</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      @if($jumlah > 0)
        <div class="container">
          <div class="row">
            <div class="col-4">
              <img src="/images/motor/{{  $motor[0]['namagambar'] }}" class="img-thumbnail rounded"> 
            </div>
            <div class="col-4">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td>{{ $motor[0]['merek'] }}</td>
                  </tr>
                  <tr>
                    <td>Tahun Produksi</td>
                    <td>:</td>
                    <td>{{ $motor[0]['tahun'] }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Transmisi</td>
                    <td>:</td>
                    <td>{{ $motor[0]['transmisi'] }}</td>
                  </tr>
                  <tr>
                    <td>Type Motor</td>
                    <td>:</td>
                    <td>
                    @for($n = 0; $n < $jumlah; $n++)
                      {{ $motor[$n]['type'] }}
                      @if($jumlah > 1)
                        @if(($n + 1) == ($jumlah - 1))
                          dan
                        @elseif(($n + 1) < ($jumlah - 1))
                          ,
                        @endif
                      @endif
                    @endfor
                    </td>
                  </tr>
                  <tr>
                    <td>Sistem Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $motor[0]['sistem'] }}</td>
                  </tr>
                  <tr>
                    <td>Volume Silinder</td>
                    <td>:</td>
                    <td>{{ $motor[0]['volume'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-4">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Konsumsi Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $motor[0]['konsumsi'] }} L/km</td>
                  </tr>
                  <tr>
                    <td>Kecepatan</td>
                    <td>:</td>
                    <td>{{ $motor[0]['kecepatan'] }} km/j</td>
                  </tr>
                  <tr>
                    <td>Kapasitas Bahan Bakar</td>
                    <td>:</td>
                    <td>{{ $motor[0]['kapasitas'] }} L</td>
                  </tr>
                  <tr>
                    <td>Dimensi</td>
                    <td>:</td>
                    <td>{{ $motor[0]['panjang']}} x {{ $motor[0]['tinggi'] }} x {{ $motor[0]['lebar'] }} mm</td>
                  </tr>
                  <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>Rp. {{ $motor[0]['harga'] }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @else
        <div class="container-fluid">
          <h5 style="color: red;">Data Sepeda Motor {{ $nama }} tidak ada</h5>
        </div>
      @endif
    </section>
  </div>
@endsection