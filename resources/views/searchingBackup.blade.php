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
    </section>
  </div>
@endsection

@section('js')
<script type="text/javascript">
  
  $(document).ready(function() {
    const table = $('#dataTable').DataTable({
        response: false,
        ajax:"{{ route('searching.getData')}}",
        type:"POST",
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

</script>
@endsection