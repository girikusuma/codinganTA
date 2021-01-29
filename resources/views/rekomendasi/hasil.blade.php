@extends('layout/main')

@section('title', 'Rekomendasi')

@section('container')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hasil Rekomendasi</h1>
          </div>
          <div class="divider"></div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
        <h5>Data Motor</h5>
        <table class="table table-striped mb-5 col-8">
            <thead>
                <tr>
                    <th scope="col">Nama Motor</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kapasitas Bahan Bakar</th>
                    <th scope="col">Kecepatan</th>
                    <th scope="col">Konsumsi Bahan Bakar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($motor as $item)
                <tr>
                    <td>{{ $item[0] }}</td>
                    <td>Rp. {{ $item[1] }}</td>
                    <td>{{ $item[2] }} Liter</td>
                    <td>{{ $item[3] }} km/jam</td>
                    <td>{{ $item[4] }} km/Liter</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
        <h5>Data Kriteria</h5>
        <table class="table table-striped mb-5 col-4">
            <thead>
                <tr>
                    <th scope="col">Nama Kriteria</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Bobot</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bobot as $item)
                <tr>
                    <td>{{ $item['kriteria'] }}</td>
                    <td>{{ $item['jenis'] }}</td>
                    <td>{{ $item['bobot'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
        <h5>Hasil Normalisasi</h5>
        <table class="table table-striped mb-5 col-8">
            <thead>
                <tr>
                    <th scope="col">Nama Motor</th>
                    <th scope="col">Kriteria 1</th>
                    <th scope="col">Kriteria 2</th>
                    <th scope="col">Kriteria 3</th>
                    <th scope="col">Kriteria 4</th>
                </tr>
            </thead>
            <tbody>
                @foreach($normalisasi as $item)
                <tr>
                    <td>{{ $item[4] }}</td>
                    <td>{{ $item[0] }}</td>
                    <td>{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    <td>{{ $item[3] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
        <h5>Nilai Pembobotan</h5>
        <table class="table table-striped mb-5 col-8">
            <thead>
                <tr>
                    <th scope="col">Nama Motor</th>
                    <th scope="col">Kriteria 1</th>
                    <th scope="col">Kriteria 2</th>
                    <th scope="col">Kriteria 3</th>
                    <th scope="col">Kriteria 4</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $item)
                <tr>
                    <td>{{ $item[4] }}</td>
                    <td>{{ $item[0] }}</td>
                    <td>{{ $item[1] }}</td>
                    <td>{{ $item[2] }}</td>
                    <td>{{ $item[3] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="divider"></div>
        <h5>Hasil Pembobotan</h5>
        <table class="table table-striped mb-5 col-4">
            <thead>
                <tr>
                    <th scope="col">Nama Motor</th>
                    <th scope="col">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hasilSAW as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['nilai'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection