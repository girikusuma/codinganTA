@extends('layout/main')

@section('title', 'Searching')

@section('container')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Searching</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <form action="{{ url('/searching') }}" method="GET">
          <div class="row">
              <div class="col">
                <div class="form-group">
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
                <div class="form-group">
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
                <div class="form-group">
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
                <div class="form-group">
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
                <div class="form-group">
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
            <div class="col mt-4">
              <input type="submit" name="cari" value="Cari" class="btn btn-primary">
              <input type="submit" name="reset" value="Reset" class="btn btn-danger">
            </div>
          </div>
        </form>
        @if($status != 0)
          <div class="text-nowrap font-weight-bold mt-3"><h2>Hasil Pencarian</h2></div>
              <div class="row">
                  <div class="col">
                      @if($jumlah > 0)
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
                  <div class="col">
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
  $(document).ready(function() {
      $('.select2').select2();
  });
  
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
</script>
@endsection