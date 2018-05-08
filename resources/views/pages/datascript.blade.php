@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
    Project DataScript
		<small>Informasi mengenai project DataScript</small>
	</h1>
  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-wrench"></i> Project</a></li>
    <li>DataScript</li>
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
      <br>
			<a id="myButton" href="#" class="btn btn-primary" onclick="tambahDatascript()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-danger" disabled><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('datascript.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
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
						<th>Tipe Truk</th>
						<th>no Truk</th>
						<th>no DO</th>
            <th>no Barang</th>
            <th>Customer</th>
            <th>Daerah</th>
            <th>Biaya lain / bongkar</th>
            <th>Delivery Cost</th>
            <th>aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formdatascript')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  var t = $('#table').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.datascript') }}",
    'dataType'    : 'json',
    'paging'      : true,
    'lengthChange': true,
    'columns'     : [
      {data:'tanggal', name: 'tanggal'},
      {data:'jenis_kendaraan', name: 'jenis_kendaraan'},
      {data:'nopol', name: 'nopol'},
      {data:'no_do', name: 'no_do'},
      {data:'barang', name: 'barang'},
      {data:'customer',name:'customer'},
      {data:'daerah',name:'daerah'},
      {data:'lain',name:'lain'},
      {data:'cost',name:'cost'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahDatascript(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#myModal').modal('show');
    $('#myModal form')[0].reset();
    $('.modal-title').text('Tambah data DataScript');
  }

  function editDatascript(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#myModal form')[0].reset();

    $.ajax({
      url: "{{url('datascript')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#myModal').modal('show');
        $('.modal-title').text('Edit data Datascript');

        $('#id').val(data.id);

        $('#datepicker').val(data.tanggal);
        $('#kendaraan').val(data.no_truck);
        $('#no_do').val(data.no_do);
        $('#jenis').val(data.tipe);
        $('#customer').val(data.customer);
        $('#barang').val(data.barang);
        $('#lain').val(data.lain);
        $('#daerah').val(data.daerah);
        $('#cost').val(data.cost);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteDatascript(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('datascript') }}" + '/' + id,
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
    if(save_method == 'add') url = "{{url('datascript')}}";
    else url = "{{url('datascript').'/'}}" + id;

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
