@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Storing
		<small>Informasi mengenai storing</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-wrench"></i> Data Storing</a></li>
	</ol>
</section>
<section class="content">
	<div class="box">
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
      <br>

			<a href="#" class="btn btn-primary" onclick="tambahStoring()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-info"><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('storing.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
      </div>
      <!-- END Export/Import Button -->

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
            <th>tanggal</th>
						<th>kendaraan</th>
						<th>Jenis Storing</th>
						<th>biaya</th>
            <th>biaya mekanik</th>
            <th>mekanik</th>
            <th>foto</th>
            <th>foto bon</th>
            <th>aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formstoring')
@include('form/importstoring')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $('#import-btn').click(function(){
      $('#import-form').modal('show');
      $('.modal-title').text('Import File From Excel');
  });

  var t = $('#table').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.storing') }}",
    'dataType'    : 'json',
    'paging'      : true,
    'lengthChange': true,
    'columns'     : [
      // {data:'id', name: 'id', orderable: false, searchable: false},
      {data:'tanggal', name: 'tanggal'},
      {data:'nopol', name: 'nopol'},
      {data:'jenis', name: 'jenis'},
      {data:'biaya', name: 'biaya'},
      {data:'biaya_mekanik', name: 'biaya_mekanik'},
      {data:'nama',name:'nama'},
      {data:'foto', name: 'foto', orderable: false, searchable: false},
      {data:'foto_bon', name: 'foto_bon', orderable: false, searchable: false},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahStoring(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#myModal').modal('show');
    $('#myModal form')[0].reset();
    $('.modal-title').text('Tambah data storing');
  }

  function editStoring(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#myModal form')[0].reset();
    $.ajax({
      url: "{{url('storing')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#myModal').modal('show');
        $('.modal-title').text('Edit data storing');

        $('#id').val(data.id);
        $('#kendaraan').val(data.kendaraan);
        $('#datepicker').val(data.tanggal);
        $('#jenis').val(data.jenis);
        $('#biaya').val(data.biaya);
        $('#biaya_mekanik').val(data.biaya_mekanik);
        $('#mekanik').val(data.mekanik)
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteStoring(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('storing') }}" + '/' + id,
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
    if(save_method == 'add') url = "{{url('storing')}}";
    else url = "{{url('storing').'/'}}" + id;

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
