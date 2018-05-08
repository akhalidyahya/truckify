@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Kendaraan
		<small>Informasi mengenai kendaraan</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-truck"></i> Data Kendaraan</a></li>
	</ol>
</section>
<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<!-- <h3 class="box-title">List Data</h3> -->
      <!-- alert success -->
      <div id="success" class="alert alert-success hide" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        Your action was <strong>Successful</strong>
      </div>
      <!-- alert error -->
      <div id="error" class="alert alert-danger hide" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        something went <strong>wrong!</strong>
      </div>
      @if(Session::has('status'))
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('status') }}
      </div>
      @endif
      <div id="error" class="alert alert-danger hide" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        something went <strong>wrong!</strong>
      </div>
      <br>

        <!-- Add Button -->
			<a href="#" class="btn btn-primary" onclick="tambahKendaraan()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-info"><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('kendaraan.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
      </div>
      <!-- END Export/Import Button -->

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>nopol</th>
						<th>stnk</th>
						<th>tahun</th>
						<th>merk</th>
            <th>daerah</th>
            <!-- <th>foto</th> -->
            <th>kir</th>
            <th>sipa</th>
            <th>ibm</th>
            <th>kiu</th>
            <th>foto</th>
            <th>aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formkendaraan')
@include('form/importkendaraan')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $('#import-btn').click(function(){
      $('#import-form').modal('show');
      $('.modal-title').text('Import File From Excel');
  });

  var t = $('#example2').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.kendaraan') }}",
    'dataType'    : 'json',
    'paging'      : true,
    'lengthChange': true,
    'columns'     : [
      {data:'id', name: 'id',orderable: false, searchable: false},
      {data:'nopol', name: 'nopol'},
      {data:'stnk', name: 'stnk'},
      {data:'tahun', name: 'tahun'},
      {data:'merk', name: 'merk'},
      {data:'daerah', name: 'daerah'},
      // {data:'foto', name: 'foto'},
      {data:'kir', name: 'kir'},
      {data:'sipa', name: 'sipa'},
      {data:'ibm', name: 'ibm'},
      {data:'kiu', name: 'kiu'},
      {data:'foto', name:'foto', orderable: false, searchable: false},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahKendaraan(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#myModal').modal('show');
    $('#myModal form')[0].reset();
    $('.modal-title').text('Tambah data kendaraan');
  }

  function editKendaraan(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#myModal form')[0].reset();
    $.ajax({
      url: "{{url('kendaraan')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#myModal').modal('show');
        $('.modal-title').text('Edit data kendaraan');

        $('#id').val(data.id);
        $('#nopol').val(data.nopol);
        $('#stnk').val(data.stnk);
        $('#tahun').val(data.tahun);
        $('#merk').val(data.merk);
        $('#daerah').val(data.daerah);
        $('#kir').val(data.kir);
        $('#sipa').val(data.sipa);
        $('#ibm').val(data.ibm);
        $('#kiu').val(data.kiu);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteKendaraan(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('kendaraan') }}" + '/' + id,
        type: "POST",
        data: {'_method': 'DELETE','_token': csrf_token},
        success: function(data) {
          t.ajax.reload();
        },
        error: function(){
          alert("something went wrong!");
        }
      });
    }
  }

  $('#submit').click(function(e){
    e.preventDefault();
    var id = $('#id').val();
    if(save_method == 'add') url = "{{url('kendaraan')}}";
    else url = "{{url('kendaraan').'/'}}" + id;

    $.ajax({
      url:url,
      type:'POST',
      // data: $('#myModal form').serialize(),
      data: new FormData($('#myModal form')[0]),
      contentType: false,
      processData: false,
      success: function($data){
        $('#success').removeClass('hide');
        $('#myModal').modal('hide');
        t.ajax.reload();
      },
      error: function(){
        $('#error').removeClass('hide');
      }
    });
  });
</script>

@endsection
