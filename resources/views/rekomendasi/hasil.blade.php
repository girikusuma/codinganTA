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
        <div class="row">
            <div class="col-4">
                <div class="card border-primary mb-3">
                    <div class="card-header">Data Kriteria</div>
                    <div class="card-body text-primary">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bobot as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['kriteria'] }}</td>
                                    <td>{{ $item['jenis'] }}</td>
                                    <td>{{ $item['bobot'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card border-secondary mb-3">
                    <div class="card-header">Data Motor</div>
                    <div class="card-body text-secondary">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item[0] }}</td>
                                    <td>Rp. {{ $item[1] }}</td>
                                    <td>{{ $item[2] }} Liter</td>
                                    <td>{{ $item[3] }} km/jam</td>
                                    <td>{{ $item[4] }} km/Liter</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col">
                <div class="card border-danger mb-3">
                    <div class="card-header">Hasil Normalisasi</div>
                    <div class="card-body text-danger">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item[4] }}</td>
                                    <td>{{ $item[0] }}</td>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[2] }}</td>
                                    <td>{{ $item[3] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
        <div class="divider"></div>
        <div class="row">
            <div class="col">
                <div class="card border-info mb-3">
                    <div class="card-header">Nilai Pembobotan</div>
                    <div class="card-body text-info">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item[4] }}</td>
                                    <td>{{ $item[0] }}</td>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[2] }}</td>
                                    <td>{{ $item[3] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col">
                <div class="card border-dark mb-3">
                    <div class="card-header">Hasil Simple Additive Weighting</div>
                    <div class="card-body text-dark">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <td scope="col">#</td>
                                    <th scope="col">Nama Motor</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilSAW as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['nilai'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Hasil Rekomendasi</div>
                    <div class="card-body">
                        <p>Sepeda Motor yang memiliki nilai pembobotan tertinggi adalah Sepeda Motor <b>{{ $hasilSAW[0]['nama'] }}</b> dengan nilai pembobotan <b>{{ $hasilSAW[0]['nilai'] }}</b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection