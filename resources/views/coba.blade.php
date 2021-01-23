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
          <div class="row">
            <div class="col">
              <div class="form-group">
                <div class="text-nowrap font-weight-bold" style="width: 8rem;">Merek Motor</div>
                <div class="input-group mb-3">
                    <select class="custom-select cari" id="cari_merek" name="cari_merek">
                        <option value="">Pilih...</option>
                        @foreach($getMerek as $item)
                          <option value="{{ $item['hasilMerek'] }}">{{ $item['hasilMerek'] }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="form-group">
                <div class="text-nowrap font-weight-bold" style="width: 8rem;">Jenis Transmisi</div>
                <div class="input-group mb-3">
                    <select class="custom-select cari" id="cari_transmisi" name="cari_transmisi">
                        <option value="">Pilih...</option>
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
                        <option value="">Pilih...</option>
                        @foreach($getType as $item)
                          <option value="{{ $item['hasilType'] }}">{{ $item['hasilType'] }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="form-group">
                <div class="text-nowrap font-weight-bold" style="width: 8rem;">Tahun Produksi</div>
                <div class="input-group mb-3">
                    <select class="custom-select cari" id="cari_tahun" name="cari_tahun">
                        <option value="">Pilih...</option>
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
                        <option value="">Pilih...</option>
                        @foreach($getVolume as $item)
                          <option value="{{ $item['hasilVolume'] }}">{{ $item['hasilVolume'] }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="py-4">
                <input type="submit" name="cari" value="Filter" class="btn btn-primary" id="cari">
                <input type="submit" name="reset" value="Reset" class="btn btn-danger" id="reset">
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="data-tables">
						<table id="dataTable" class="table table-bordered table-striped">
							<thead class="bg-light text-capitalize">
								<tr>
									<th>Nama</th>
                  <th>Merek</th>
                  <th>Transmisi</th>
                  <th>Type</th>
                  <th>Tahun</th>
                  <th>Volume</th>
								</tr>
							</thead>
						</table>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
<script type="text/javascript">
    
    let merek = $('#cari_merek').val();
    let transmisi = $('#cari_transmisi').val();
    let typemotor = $('#cari_typemotor').val();
    let tahun = $('#cari_tahun').val();
    let volume = $('#cari_volume').val();

  $(document).ready(function() {
    const table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax:"{{ route('searching.getData')}}",
        type:"POST",
        data: function(d){
          d.merek = merek;
          d.transmisi = transmisi;
          d.typemotor = typemotor;
          d.tahun = tahun;
          d.volume = volume;

          return d;
        }
        columns : [
          {data: 'nama'},
          {data: 'merek'},
          {data: 'transmisi'},
          {data: 'type'},
          {data: 'tahun'},
          {data: 'volume'}
        ],
      });
  });

  $(".cari").on('change', function(){
    merek = $('#cari_merek').val();
    transmisi = $('#cari_transmisi').val();
    typemotor = $('#cari_typemotor').val();
    tahun = $('#cari_tahun').val();
    volume = $('#cari_volume').val();
    
    table.ajax.reload(null,false);
  });
</script>
@endsection