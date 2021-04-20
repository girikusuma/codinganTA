@extends('layout/main')

@section('title', 'Rekomendasi')

@section('container')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pilih Kriteria</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <h4 class="text-dark">Cara input motor</h4>
        <select name="filter" id="filter" class="custom-select col-lg-4">
          <option value="kosong">Pilih</option>
          <option value="filter_kriteria">Filter kriteria</option>
          <option value="check">Checked motor</option>
        </select>
      </div>
      <div class="container-fluid">
        <form action="{{ route('rekomendasi.result') }}" method="POST" id="form_filter" class="mt-4">
          @csrf
          <div class="form-group" id="filter_merek_motor">
            <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
            <div class="input-group mb-3">
              <select class="custom-select" id="merek" name="merek">
                <option value="semua">Pilih...</option>
              @foreach($getMerek as $item)
                <option value="{{ $item['hasilMerek'] }}">{{ $item['namaMerek'] }}</option>
              @endforeach
              </select>
            </div>
          </div>
          <div class="form-group" id="filter_transmisi_motor">
            <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
            <div class="input-group mb-3">
                <select class="custom-select" id="transmisi" name="transmisi">
                    <option value="semua">Pilih...</option>
                    @foreach($getTransmisi as $item)
                      <option value="{{ $item['hasilTransmisi'] }}">{{ $item['namaTransmisi'] }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="form-group" id="filter_type_motor">
            <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
            <div class="input-group mb-3">
                <select class="custom-select" id="typemotor" name="typemotor">
                    <option value="semua">Pilih...</option>
                    @foreach($getType as $item)
                      <option value="{{ $item['hasilType'] }}">{{ $item['namaType'] }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="form-group" id="filter_tahun_motor">
            <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
            <div class="input-group mb-3">
                <select class="custom-select" id="tahun" name="tahun">
                    <option value="semua">Pilih...</option>
                    @foreach($getTahun as $item)
                      <option value="{{ $item['hasilTahun'] }}">{{ $item['namaTahun'] }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <!-- <div class="form-group" id="filter_volume_motor">
            <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
            <div class="input-group mb-3">
                <select class="custom-select" id="volume" name="volume">
                    <option value="semua">Pilih...</option>
                    @foreach($getVolume as $item)
                      <option value="{{ $item['hasilVolume'] }}">{{ $item['namaVolume'] }}</option>
                    @endforeach
                </select>
            </div>
          </div> -->
          <div id="tombol_filter">
            <input type="submit" name="cari_filter" value="Lihat Rekomendasi" class="btn btn-primary">
          </div>
        </form>
        <form action="{{ route('rekomendasi.result') }}" method="POST" id="form_checked" class="mt-4">
          @csrf
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">Pilih Motor</div>
                <div class="card-body" id="boxes">
                  <table class="table table-scroll">
                    <thead>
                      <tr>
                        <th scope="col">Check</th>
                        <th scope="col">Nama</th>
                      </tr>
                    </thead>
                    <tbody class="tbody-scroll ml-4">
                    @foreach($getMotor as $item)
                      <tr>
                        <td align="center"><input type="checkbox" name="motor[]" id="motor" value="{{ $item['id'] }}"></td>
                        <td>{{ $item['nama'] }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <input type="submit" name="cari_checkbox" id="btn_post" value="Lihat Rekomendasi" class="btn btn-primary disable">
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
  if(document.getElementById("filter").value == "kosong"){
    $("#form_filter").hide();
    $("#form_checked").hide();
  }
  $("#filter").change(function() {
    if ($(this).val() == "filter_kriteria") {
      $("#form_filter").show();
      $("#form_checked").hide();
    } else if ($(this).val() == "check") {
      $("#form_filter").hide();
      $("#form_checked").show();
    } else {
      $("#form_filter").hide();
      $("#form_checked").hide();
    }
  });
  document.getElementById("btn_post").disabled = true;
  $(document).ready(function(){
    $("#boxes input[type='checkbox']").click(function(){
      var total=0;
      $("#boxes input[type='checkbox']:checked").each(function(){
            total += 1;
      });
      console.log(total);
      if(total > 1){
        document.getElementById("btn_post").disabled = false;
      } else {
        document.getElementById("btn_post").disabled = true;
      }
    });
  });
</script>
@endsection