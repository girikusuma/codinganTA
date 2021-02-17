@extends('layout/main')

@section('title', 'Detail Motor')

@section('container')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Sepeda Motor</h1>
        </div>
      </div>
      <div class="card text-center">
        <div class="card-body">
          <h4>{{ $nama }}</h4>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    @if($jumlah > 0)
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <div class="row">
            <div class="col">
              <div class="card border-success mb-3">
                <div class="card-header text-center">Gambar {{ $nama }}</div>
                <div class="card-body text-success text-center">
                  <img src="/images/motor/{{  $motor[0]['namagambar'] }}" class="img-thumbnail rounded"> 
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border-danger mb-3">
                <div class="card-header text-center">Instance Atribute</div>
                <div class="card-body text-decoration-none">
                  <table class="table">
                    <tbody>
                      <tr><p></p>
                        <th scope="row">Type</th>
                        <td>Individual</td>
                      </tr>
                      <tr>
                        <th scope="row">Domain</th>
                        <td>OntologiSepedaMotor</td>
                      </tr>
                      <tr>
                        <th scope="row">Prefix</th>
                        <td>Motor</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-8">
          <div class="card border-info mb-3">
            <div class="card-header text-center">Tentang {{ $nama }}</div>
            <div class="card-body text-info">
              <div class="row">
                <div class="col">
                  <p><b>Berdasarkan Object Property</b></p>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td class="col">Merek</td>
                        <td>:</td>
                        <td><a href="{{ url('/listmerek/'.$motor[0]['merek'].'/') }}">{{ $motor[0]['merek'] }}</a></td>
                      </tr>
                      <tr>
                        <td class="col">Tahun Produksi</td>
                        <td>:</td>
                        <td><a href="{{ url('/listtahun/'.$motor[0]['tahun'].'/') }}">{{ $motor[0]['tahun'] }}</a></td>
                      </tr>
                      <tr>
                        <td class="col">Jenis Transmisi</td>
                        <td>:</td>
                        <td><a href="{{ url('/listtransmisi/'.$motor[0]['transmisi'].'/') }}">{{ $motor[0]['transmisi'] }}</a></td>
                      </tr>
                      <tr>
                        <td class="col">Type Motor</td>
                        <td>:</td>
                        <td>
                        @for($n = 0; $n < $jumlah; $n++)
                          <a href="{{ url('/listtype/'.$motor[$n]['type'].'/') }}">{{ $motor[$n]['type'] }}</a>
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
                        <td class="col">Sistem Bahan Bakar</td>
                        <td>:</td>
                        <td>{{ $motor[0]['sistem'] }}</td>
                      </tr>
                      <tr>
                        <td class="col">Volume Silinder</td>
                        <td>:</td>
                        <td><a href="{{ url('/listvolumesilinder/'.$motor[0]['volume'].'/') }}">{{ $motor[0]['volume'] }}</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p><b>Berdasarkan Data Property</b></p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <table class="table">
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
          </div>
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