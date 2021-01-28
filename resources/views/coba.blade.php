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
            </div>
            <div class="col">
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
            </div>
            <div class="col">
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
            </div>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" id="cari" name="cari" class="btn btn-primary" value="Filter"></input>
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

  $(document).ready(function() {
    
    alert("Masuk document ready");
    
    fill_datatable();
    
    function fill_datatable(){
      alert("Masik fill data");
        $('#dataTable').DataTable({
          response: false,
          processing: true,
          ajax:"{{ route('coba.getData')}}",
          columns : [
            {
              data: 'nama',
              name: 'nama'  
            },
            {
              data: 'merek',
              name: 'merek'
            },
            {
              data: 'transmisi',
              name: 'transmisi'
            },
            {
              data: 'type',
              name: 'type'  
            },
            {
              data: 'tahun',
              name: 'tahun'  
            },
            {
              data: 'volume',
              name: 'volume'  
            }
          ],
          order: [
            [0, 'asc']
          ]
      });
    }

    function filter_datatable(cari_merek, cari_transmisi, cari_typemotor, cari_tahun, cari_volume){
      $('#dataTable').Datatable({
            response: false,
            processing: true,
            ajax:{
              url: "{{ route('coba.filterData')}}",
              data: {
                cari_merek:cari_merek,
                cari_transmisi:cari_transmisi,
                cari_typemotor:cari_typemotor,
                cari_tahun:cari_tahun,
                cari_volume:cari_volume
              }
            },
            columns : [
              {
                data: 'nama',
                name: 'nama'  
              },
              {
                data: 'merek',
                name: 'merek'
              },
              {
                data: 'transmisi',
                name: 'transmisi'
              },
              {
                data: 'type',
                name: 'type'  
              },
              {
                data: 'tahun',
                name: 'tahun'  
              },
              {
                data: 'volume',
                name: 'volume'  
              }
            ],
            order: [
              [0, 'asc']
            ]
      });
    }

    $("#cari").click(function(){
      alert("Masuk Filter 1");
      var cari_merek = $('#cari_merek').val();
      var cari_transmisi = $('#cari_transmisi').val();
      var cari_typemotor = $('#cari_typemotor').val();
      var cari_tahun = $('#cari_tahun').val();
      var cari_volume = $('#cari_volume').val();

      table.destroy();
      //filter_datatable(cari_merek, cari_transmisi, cari_typemotor, cari_tahun, cari_volume);
    });
  });
  
  $("#cari").click(function(){
    alert("Masuk Filter 1");
    var cari_merek = $('#cari_merek').val();
    var cari_transmisi = $('#cari_transmisi').val();
    var cari_typemotor = $('#cari_typemotor').val();
    var cari_tahun = $('#cari_tahun').val();
    var cari_volume = $('#cari_volume').val();

    $('#dataTable').Datatable().destroy();
    // filter_datatable(cari_merek, cari_transmisi, cari_typemotor, cari_tahun, cari_volume);
  });
</script>
@endsection