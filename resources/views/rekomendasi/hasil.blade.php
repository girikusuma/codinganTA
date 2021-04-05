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
        @if($jumlah > 2)
        <div class="row mb-4" id="lihat_detail">
            <div class="col">
                <input class="btn btn-primary" type="submit" value="Lihat Detail">
            </div>
        </div>
        <div class="row" id="card_kriteria">
            <div class="col-lg-6">
                <div class="card border-primary mb-3">
                    <div class="card-header text-bold">Data Kriteria</div>
                    <div class="card-body text-primary">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Kriteria</th>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bobot as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['kode'] }}</td>
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
            <div class="divider"></div>
        </div>
        <div class="row" id="card_crips">
            <div class="col-lg-8">
                <div class="card border-warning mb-3">
                    <div class="card-header text-bold">Data Crips</div>
                    <div class="card-body  text-decoration-none">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Kriteria</th>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Crips</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($crips as $item)
                                    @foreach($item as $key)
                                        <tr>
                                            <td>{{ $key['iterasi'] }}</td>
                                            <td>{{ $key['kode'] }}</td>
                                            <td>{{ $key['nama'] }}</td>
                                            <td><= {{ $key['crips'] }}</td>
                                            <td>{{ $key['nilai'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>
        <div class="row" id="card_alternatif">
            <div class="col-lg-12">
                <div class="card border-secondary mb-3">
                    <div class="card-header text-bold">Data Alternatif</div>
                    <div class="card-body text-secondary">
                        <table class="table table-striped mb-5 col-lg-12">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Motor</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="font-size: 1.05vw;">KapasitasBBM</th>
                                    <th scope="col">Kecepatan</th>
                                    <th scope="col" style="font-size: 1.05vw;">KonsumsiBBM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($motor as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>Rp. {{ $item['Harga'] }}</td>
                                    <td>{{ $item['KapasitasBBM'] }} Liter</td>
                                    <td>{{ $item['Kecepatan'] }} km/jam</td>
                                    <td>{{ $item['KonsumsiBBM'] }} km/Liter</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>
        <div class="row" id="card_nilai_alternatif">
            <div class="col-lg-8">
                <div class="card border-success mb-3">
                    <div class="card-header text-bold">Data Nilai Alternatif</div>
                    <div class="card-body text-success">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Motor</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="font-size: 1.05vw;">KapasitasBBM</th>
                                    <th scope="col">Kecepatan</th>
                                    <th scope="col" style="font-size: 1.05vw;">KonsumsiBBM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alternatif as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['Harga'] }}</td>
                                    <td>{{ $item['KapasitasBBM'] }}</td>
                                    <td>{{ $item['Kecepatan'] }}</td>
                                    <td>{{ $item['KonsumsiBBM'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>
        <div class="row" id="card_normalisasi">
            <div class="col-lg-12">
                <div class="card border-danger mb-3">
                    <div class="card-header text-bold">Hasil Normalisasi</div>
                    <div class="card-body text-danger">
                        <table class="table table-striped mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Motor</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="font-size: 1.05vw;">KapasitasBBM</th>
                                    <th scope="col">Kecepatan</th>
                                    <th scope="col" style="font-size: 1.05vw;">KonsumsiBBM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($normalisasi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['Harga'] }}</td>
                                    <td>{{ $item['KapasitasBBM'] }}</td>
                                    <td>{{ $item['Kecepatan'] }}</td>
                                    <td>{{ $item['KonsumsiBBM'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>      
        <div class="row" id="card_pembobotan">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header text-bold">Nilai Pembobotan</div>
                    <div class="card-body text-info">
                        <table class="table table-striped mb-5 col-lg-12">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                   <th scope="col">Nama Motor</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" style="font-size: 1.05vw;">KapasitasBBM</th>
                                    <th scope="col">Kecepatan</th>
                                    <th scope="col" style="font-size: 1.05vw;">KonsumsiBBM</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ranking as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['Harga'] }}</td>
                                    <td>{{ $item['KapasitasBBM'] }}</td>
                                    <td>{{ $item['Kecepatan'] }}</td>
                                    <td>{{ $item['KonsumsiBBM'] }}</td>
                                    <td>{{ $item['total'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </div>
        <div class="row" id="card_hasil">
            <div class="col">
                <div class="card border-dark mb-3">
                    <div class="card-header text-bold">Hasil Simple Additive Weighting</div>
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
        @else
            <h3>Data sepeda motor dengan kriteria tersebut tidak ada atau kurang dari 2</h3>
        @endif
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $('#lihat_detail').show();
    $('#card_pembobotan').show();
    $('#card_hasil').show();
    $('#card_kriteria').hide();
    $('#card_crips').hide();
    $('#card_alternatif').hide();
    $('#card_nilai_alternatif').hide();
    $('#card_normalisasi').hide();

    $("#lihat_detail").click(function() {
      $('#lihat_detail').hide();
      $('#card_pembobotan').show();
      $('#card_hasil').show();
      $('#card_kriteria').show();
      $('#card_crips').show();
      $('#card_alternatif').show();
      $('#card_nilai_alternatif').show();
      $('#card_normalisasi').show();
    });
</script>
@endsection