@extends('layout/main')

@section('title', 'Rekomendasi')

@section('container')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pilih Kriteria</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <form action="{{ url('/rekomendasi/result') }}" method="POST">
          @csrf
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="merek" name="merek">
                  <option value="semua">Semua</option>
                  @foreach($getMerek as $item)
                    <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="transmisi" name="transmisi">
                  <option value="semua">Semua</option>
                  @foreach($getTransmisi as $item)
                    <option value="{{ $item['hasilTransmisi'] }}">{{ $item['hasilTransmisi'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Type Motor</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="typemotor" name="typemotor">
                  <option value="semua">Semua</option>
                  @foreach($getType as $item)
                    <option value="{{ $item['hasilType'] }}">{{ $item['hasilType'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="tahun" name="tahun">
                  <option value="semua">Semua</option>
                  @foreach($getTahun as $item)
                    <option value="{{ $item['hasilTahun'] }}">{{ $item['hasilTahun'] }}</option>
                  @endforeach
              </select>
          </div>
          <div class="text-nowrap font-weight-bold" style="width: 8rem;">Volume Silinder</div>
          <div class="input-group mb-3">
              <select class="custom-select" id="volume" name="volume">
                  <option value="semua">Semua</option>
                  @foreach($getVolume as $item)
                    <option value="{{ $item['hasilVolume'] }}">{{ $item['hasilVolume'] }}</option>
                  @endforeach
              </select>
          </div>
          <input type="submit" name="cari" value="Lihat Rekomendasi" class="btn btn-primary">
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection