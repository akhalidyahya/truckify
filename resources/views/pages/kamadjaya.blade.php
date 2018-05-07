@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Kamadjaya
		<small>Informasi mengenai project kamadjaya</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-wrench"></i> Project </a></li>
    <li>Kamadjaya</li>
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
      <br>
			<a href="#" class="btn btn-primary" onclick="tambahKamadjaya()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-danger" disabled><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('kamadjaya.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
      </div>
      <!-- END Export/Import Button -->

		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
            <th>Tanggal</th>
            <th>No Kendaraan</th>
            <th>No DO</th>
            <th>Tipe Kendaraan</th>
            <th>customer</th>
            <th>Destinasi</th>
            <th>Wilayah</th>
            <th>Daerah</th>
            <th>Qty</th>
            <th>Total m3/DO</th>
            <th>Desc</th>
            <th>Delivery Cost</th>
            <th>Aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formkamadjaya')
@include('form/importkamadjaya')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  // $('#import-btn').click(function(){
  //     $('#import-form').modal('show');
  //     $('.modal-title').text('Import File From Excel');
  // });
  var t = $('#example2').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.kamadjaya') }}",
    'dataType'    : 'json',
    'paging'      : true,
    'lengthChange': true,
    'columns'     : [
      {data:'tanggal', name: 'tanggal'},
      {data:'nopol', name: 'nopol'},
      {data:'no_do', name: 'no_do'},
      {data:'jenis_kendaraan', name: 'jenis_kendaraan'},
      {data:'customer', name: 'customer'},
      {data:'destinasi', name: 'destinasi'},
      {data:'wilayah', name: 'wilayah'},
      {data:'daerah', name: 'daerah'},
      {data:'qty', name: 'qty'},
      {data:'total_do', name: 'total_do'},
      {data:'desc', name: 'desc'},
      {data:'cost', name: 'cost'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false}
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahKamadjaya(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#myModal').modal('show');
    $('#myModal form')[0].reset();
    $('.modal-title').text('Tambah data Kamadjaya');
  }

  function editKamadjaya(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#myModal form')[0].reset();
    $.ajax({
      url: "{{url('kamadjaya')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#myModal').modal('show');
        $('.modal-title').text('Edit data kamadjaya');

        $('#id').val(data.id);

        $('#datepicker').val(data.tanggal);
        $('#kendaraan').val(data.no_truck);
        $('#no_do').val(data.no_do);
        $('#jenis').val(data.tipe);
        $('#customer').val(data.customer);
        $('#destinasi').val(data.destinasi);
        $('#wilayah').val(data.wilayah);
        $('#daerah').val(data.daerah);
        $('#jumlah').val(data.qty);
        $('#m3do').val(data.total_do);
        $('#desc').val(data.desc);
        $('#cost').val(data.cost);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteKamadjaya(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('kamadjaya') }}" + '/' + id,
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
    if(save_method == 'add') url = "{{url('kamadjaya')}}";
    else url = "{{url('kamadjaya').'/'}}" + id;

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
