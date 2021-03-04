@extends('layout/main')

@section('title', 'Searching')

@section('container')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <h1 class="text-dark">Searching</h1>
            <div class="divider"></div>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <h4 class="text-dark">Output</h4>
        <select name="filter_output" id="filter_output" class="custom-select col-lg-4">
          <option value="">Pilih</option>
          <option value="motor">Motor</option>
          <option value="dealer">Dealer</option>
          <option value="service">Service Center</option>
        </select>
        <input type="hidden" id="sts" value="{{ $status }}">
        <h4 class="text-dark mt-4">Input</h4>
        <div class="card border-danger mb-3 col-lg-4" id="filter_none">
          <div class="card-body text-danger">
            <p class="card-text">Pilih output terlebih dahulu!!!</p>
          </div>
        </div>
        <form action="{{ route('searching.index') }}" method="GET">
          <div class="row">
              <div class="col">
                <div class="form-group" id="filter_merek_motor">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_merek" name="cari_merek">
                          <option value="semua">Pilih...</option>
                          @foreach($getMerek as $item)
                            <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group" id="filter_transmisi_motor">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_transmisi" name="cari_transmisi">
                          <option value="semua">Pilih...</option>
                          @foreach($getTransmisi as $item)
                            <option value="{{ $item['hasilTransmisi'] }}">{{ $item['hasilTransmisi'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group" id="filter_type_motor">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_typemotor" name="cari_typemotor">
                          <option value="semua">Pilih...</option>
                          @foreach($getType as $item)
                            <option value="{{ $item['hasilType'] }}">{{ $item['hasilType'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group" id="filter_tahun_motor">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_tahun" name="cari_tahun">
                          <option value="semua">Pilih...</option>
                          @foreach($getTahun as $item)
                            <option value="{{ $item['hasilTahun'] }}">{{ $item['hasilTahun'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group" id="filter_volume_motor">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_volume" name="cari_volume">
                          <option value="semua">Pilih...</option>
                          @foreach($getVolume as $item)
                            <option value="{{ $item['hasilVolume'] }}">{{ $item['hasilVolume'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            <div class="col mt-4" id="filter_tombol_motor">
              <input type="submit" name="cari" value="Cari" class="btn btn-primary">
              <input type="submit" name="reset" value="Reset" class="btn btn-danger">
            </div>
          </div>
        </form>
        <form action="{{ route('searching.index') }}" method="GET">
          <div class="row">
              <div class="col">
                <div class="form-group" id="filter_merek_dealer">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Dealer</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_merek_dealer" name="cari_merek_dealer">
                          <option value="semua">Pilih...</option>
                          @foreach($getMerek as $item)
                            <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group" id="filter_lokasi_dealer">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Lokasi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_lokasi_dealer" name="cari_lokasi_dealer">
                          <option value="semua">Pilih...</option>
                          @foreach($getLokasi as $item)
                            <option value="{{ $item['hasilLokasi'] }}">{{ $item['hasilLokasi'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            <div class="col mt-4" id="filter_tombol_dealer">
              <input type="submit" name="cari_dealer" value="Cari" class="btn btn-primary">
              <input type="submit" name="reset_dealer" value="Reset" class="btn btn-danger">
            </div>
          </div>
        </form>
        <form action="{{ route('searching.index') }}" method="GET">
          <div class="row">
              <div class="col">
                <div class="form-group" id="filter_merek_service">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Service Center</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_merek_service" name="cari_merek_service">
                          <option value="semua">Pilih...</option>
                          @foreach($getMerek as $item)
                            <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group" id="filter_lokasi_service">
                  <div class="text-nowrap font-weight-bold" style="width: 8rem;">Lokasi</div>
                  <div class="input-group mb-3">
                      <select class="custom-select cari" id="cari_lokasi_service" name="cari_lokasi_service">
                          <option value="semua">Pilih...</option>
                          @foreach($getLokasi as $item)
                            <option value="{{ $item['hasilLokasi'] }}">{{ $item['hasilLokasi'] }}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              </div>
            <div class="col mt-4" id="filter_tombol_service">
              <input type="submit" name="cari_service" value="Cari" class="btn btn-primary">
              <input type="submit" name="reset_service" value="Reset" class="btn btn-danger">
            </div>
          </div>
        </form>
        @if($status == 1)
          <div class="text-nowrap font-weight-bold mt-3" id="hasil_motor"><h2>Hasil Pencarian</h2></div>
            <div class="row">
                <div class="col"  id="hasil_motor_tabel">
                    @if($jumlahMotor > 0)
                    <div class="card border-warning mb-3">
                        <div class="card-header">Sepeda Motor</div>
                        <div class="card-body text-decoration-none">
                            <table class="table mt-n2 table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Motor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getMotor as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{ url('/listmotor/'.$item['id'].'/') }}" class="text-decoration-none text-muted">{{ $item['nama'] }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h6>Data sepeda motor dengan kriteria tersebut tidak ada.</h6>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col"  id="hasil_motor_query">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">SPARQL QUERY</div>
                        <div class="card-body">
                            <p class="card-text">{{ $query }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="hidden" id="merek" value="{{ $merek }}">
                <input type="hidden" id="transmisi" value="{{ $transmisi }}">
                <input type="hidden" id="typemotor" value="{{ $jenis }}">
                <input type="hidden" id="tahun" value="{{ $tahun }}">
                <input type="hidden" id="volume" value="{{ $volume }}">
                <input type="hidden" id="filter" value="motor">
              </div>
            </div>
          </div>
          @elseif($status == 2)
          <div class="text-nowrap font-weight-bold mt-3" id="hasil_dealer"><h2>Hasil Pencarian</h2></div>
            <div class="row">
                <div class="col"  id="hasil_dealer_tabel">
                    @if($jumlahDealer > 0)
                    <div class="card border-warning mb-3">
                        <div class="card-header">Dealer</div>
                        <div class="card-body text-decoration-none">
                            <table class="table mt-n2 table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Dealer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getDealer as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{ route('dealer.detail', [$item['id']]) }}" class="text-decoration-none text-muted">{{ $item['nama'] }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h6>Data dealer tidak ada.</h6>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col"  id="hasil_dealer_query">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">SPARQL QUERY</div>
                        <div class="card-body">
                            <p class="card-text">{{ $query }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="hidden" id="merek_dealer" value="{{ $merek }}">
                <input type="hidden" id="lokasi_dealer" value="{{ $lokasi }}">
                <input type="hidden" id="filter" value="dealer">
              </div>
            </div>
          </div>
          @elseif($status == 3)
          <div class="text-nowrap font-weight-bold mt-3" id="hasil_service"><h2>Hasil Pencarian</h2></div>
            <div class="row">
                <div class="col"  id="hasil_service_tabel">
                    @if($jumlahService > 0)
                    <div class="card border-warning mb-3">
                        <div class="card-header">Service Center</div>
                        <div class="card-body text-decoration-none">
                            <table class="table mt-n2 table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Service Center</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getService as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="{{ route('service.detail', [$item['id']]) }}" class="text-decoration-none text-muted">{{ $item['nama'] }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h6>Data service center tidak ada.</h6>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col"  id="hasil_service_query">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">SPARQL QUERY</div>
                        <div class="card-body">
                            <p class="card-text">{{ $query }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col">
                <input type="hidden" id="merek_service" value="{{ $merek }}">
                <input type="hidden" id="lokasi_service" value="{{ $lokasi }}">
                <input type="hidden" id="filter" value="service">
              </div>
            </div>
          </div>
        @elseif($status == 0)
          <div class="row">
            <div class="col">
              <input type="hidden" id="merek" value="semua">
              <input type="hidden" id="transmisi" value="semua">
              <input type="hidden" id="typemotor" value="semua">
              <input type="hidden" id="tahun" value="semua">
              <input type="hidden" id="volume" value="semua">
              <input type="hidden" id="merek_service" value="semua">
              <input type="hidden" id="lokasi_service" value="semua">
              <input type="hidden" id="merek_dealer" value="semua">
              <input type="hidden" id="lokasi_dealer" value="semua">
              <input type="hidden" id="filter" value="">
            </div>
          </div>
        @endif
      </div>
    </section>
  </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>

  if(document.getElementById("sts").value == 0){
    $('#filter_none').show();
    $('#filter_merek_motor').hide();
    $('#filter_transmisi_motor').hide();
    $('#filter_type_motor').hide();
    $('#filter_tahun_motor').hide();
    $('#filter_volume_motor').hide();
    $('#filter_tombol_motor').hide();
    $('#hasil_motor').hide();
    $('#hasil_motor_tabel').hide();
    $('#hasil_motor_query').hide();
    $('#filter_merek_dealer').hide();
    $('#filter_lokasi_dealer').hide();
    $('#filter_tombol_dealer').hide();
    $('#hasil_dealer').hide();
    $('#hasil_dealer_tabel').hide();
    $('#hasil_dealer_query').hide();
    $('#filter_merek_service').hide();
    $('#filter_lokasi_service').hide();
    $('#filter_tombol_service').hide();
    $('#hasil_service').hide();
    $('#hasil_service_tabel').hide();
    $('#hasil_service_query').hide();
  }

  $("#filter_output").change(function() {
    if ($(this).val() == "motor") {
      $('#filter_merek_motor').show();
      $('#filter_transmisi_motor').show();
      $('#filter_type_motor').show();
      $('#filter_tahun_motor').show();
      $('#filter_volume_motor').show();
      $('#filter_tombol_motor').show();
      $('#hasil_motor').show();
      $('#hasil_motor_tabel').show();
      $('#hasil_motor_query').show();
      $('#filter_merek_dealer').hide();
      $('#filter_lokasi_dealer').hide();
      $('#filter_tombol_dealer').hide();
      $('#hasil_dealer').hide();
      $('#hasil_dealer_tabel').hide();
      $('#hasil_dealer_query').hide();
      $('#filter_merek_service').hide();
      $('#filter_lokasi_service').hide();
      $('#filter_tombol_service').hide();
      $('#hasil_service').hide();
      $('#hasil_service_tabel').hide();
      $('#hasil_service_query').hide();
      $('#filter_none').hide();

    } else if ($(this).val() == "dealer") {
      $('#filter_merek_dealer').show();
      $('#filter_lokasi_dealer').show();
      $('#filter_tombol_dealer').show();
      $('#hasil_dealer').show();
      $('#hasil_dealer_tabel').show();
      $('#hasil_dealer_query').show();
      $('#filter_merek_motor').hide();
      $('#filter_transmisi_motor').hide();
      $('#filter_type_motor').hide();
      $('#filter_tahun_motor').hide();
      $('#filter_volume_motor').hide();
      $('#filter_tombol_motor').hide();
      $('#hasil_motor').hide();
      $('#hasil_motor_tabel').hide();
      $('#hasil_motor_query').hide();
      $('#filter_merek_service').hide();
      $('#filter_lokasi_service').hide();
      $('#filter_tombol_service').hide();
      $('#hasil_service').hide();
      $('#hasil_service_tabel').hide();
      $('#hasil_service_query').hide();
      $('#filter_none').hide();

    } else if ($(this).val() == "service") {
      $('#filter_merek_service').show();
      $('#filter_lokasi_service').show();
      $('#filter_tombol_service').show();
      $('#hasil_service').show();
      $('#hasil_service_tabel').show();
      $('#hasil_service_query').show();
      $('#filter_merek_motor').hide();
      $('#filter_transmisi_motor').hide();
      $('#filter_type_motor').hide();
      $('#filter_tahun_motor').hide();
      $('#filter_volume_motor').hide();
      $('#filter_tombol_motor').hide();
      $('#hasil_motor').hide();
      $('#hasil_motor_tabel').hide();
      $('#hasil_motor_query').hide();
      $('#filter_merek_dealer').hide();
      $('#filter_lokasi_dealer').hide();
      $('#filter_tombol_dealer').hide();
      $('#hasil_dealer').hide();
      $('#hasil_dealer_tabel').hide();
      $('#hasil_dealer_query').hide();
      $('#filter_none').hide();

    } else {
      $('#filter_none').show();
      $('#filter_merek_motor').hide();
      $('#filter_transmisi_motor').hide();
      $('#filter_type_motor').hide();
      $('#filter_tahun_motor').hide();
      $('#filter_volume_motor').hide();
      $('#filter_tombol_motor').hide();
      $('#hasil_motor').hide();
      $('#hasil_motor_tabel').hide();
      $('#hasil_motor_query').hide();
      $('#filter_merek_dealer').hide();
      $('#filter_lokasi_dealer').hide();
      $('#filter_tombol_dealer').hide();
      $('#hasil_dealer').hide();
      $('#hasil_dealer_tabel').hide();
      $('#hasil_dealer_query').hide();
      $('#filter_merek_service').hide();
      $('#filter_lokasi_service').hide();
      $('#filter_tombol_service').hide();
      $('#hasil_service').hide();
      $('#hasil_service_tabel').hide();
      $('#hasil_service_query').hide();

    }
  });

  $(document).ready(function() {
      $('.select2').select2();
  });

  var filter = document.getElementById("filter").value;  

  document.getElementById('filter_output').value = filter;
  
  if (filter == "motor") {
    var merek = document.getElementById("merek").value;
    var transmisi = document.getElementById("transmisi").value;
    var typemotor = document.getElementById("typemotor").value;
    var tahun = document.getElementById("tahun").value;
    var volume = document.getElementById("volume").value;
    
    document.getElementById("cari_merek").value = merek;
    document.getElementById("cari_transmisi").value = transmisi;
    document.getElementById("cari_typemotor").value = typemotor;
    document.getElementById("cari_tahun").value = tahun;
    document.getElementById("cari_volume").value = volume;
    
    $('#filter_merek_dealer').hide();
    $('#filter_lokasi_dealer').hide();
    $('#filter_tombol_dealer').hide();
    $('#hasil_dealer').hide();
    $('#hasil_dealer_tabel').hide();
    $('#hasil_dealer_query').hide();
    $('#filter_merek_service').hide();
    $('#filter_lokasi_service').hide();
    $('#filter_tombol_service').hide();
    $('#hasil_service').hide();
    $('#hasil_service_tabel').hide();
    $('#hasil_service_query').hide();
    $('#filter_none').hide();
  } else if (filter == "dealer") {
    var merek = document.getElementById("merek_dealer").value;
    var lokasi = document.getElementById("lokasi_dealer").value;

    document.getElementById("cari_merek_dealer").value = merek;
    document.getElementById("cari_lokasi_dealer").value = lokasi;

    $('#filter_merek_motor').hide();
    $('#filter_transmisi_motor').hide();
    $('#filter_type_motor').hide();
    $('#filter_tahun_motor').hide();
    $('#filter_volume_motor').hide();
    $('#filter_tombol_motor').hide();
    $('#hasil_motor').hide();
    $('#hasil_motor_tabel').hide();
    $('#hasil_motor_query').hide();
    $('#filter_merek_service').hide();
    $('#filter_lokasi_service').hide();
    $('#filter_tombol_service').hide();
    $('#hasil_service').hide();
    $('#hasil_service_tabel').hide();
    $('#hasil_service_query').hide();
    $('#filter_none').hide();
  } else if (filter == "service") {
    var merek = document.getElementById("merek_service").value;
    var lokasi = document.getElementById("lokasi_service").value;
    console.log(merek);
    document.getElementById("cari_merek_service").value = merek;
    document.getElementById("cari_lokasi_service").value = lokasi;

    $('#filter_merek_dealer').hide();
    $('#filter_lokasi_dealer').hide();
    $('#filter_tombol_dealer').hide();
    $('#hasil_dealer').hide();
    $('#hasil_dealer_tabel').hide();
    $('#hasil_dealer_query').hide();
    $('#filter_merek_motor').hide();
    $('#filter_transmisi_motor').hide();
    $('#filter_type_motor').hide();
    $('#filter_tahun_motor').hide();
    $('#filter_volume_motor').hide();
    $('#filter_tombol_motor').hide();
    $('#hasil_motor').hide();
    $('#hasil_motor_tabel').hide();
    $('#hasil_motor_query').hide();
    $('#filter_none').hide();
  } else {
    $('#filter_none').show();
    $('#filter_merek_motor').hide();
    $('#filter_transmisi_motor').hide();
    $('#filter_type_motor').hide();
    $('#filter_tahun_motor').hide();
    $('#filter_volume_motor').hide();
    $('#filter_tombol_motor').hide();
    $('#hasil_motor').hide();
    $('#hasil_motor_tabel').hide();
    $('#hasil_motor_query').hide();
    $('#filter_merek_dealer').hide();
    $('#filter_lokasi_dealer').hide();
    $('#filter_tombol_dealer').hide();
    $('#hasil_dealer').hide();
    $('#hasil_dealer_tabel').hide();
    $('#hasil_dealer_query').hide();
    $('#filter_merek_service').hide();
    $('#filter_lokasi_service').hide();
    $('#filter_tombol_service').hide();
    $('#hasil_service').hide();
    $('#hasil_service_tabel').hide();
    $('#hasil_service_query').hide();
  }
</script>
@endsection