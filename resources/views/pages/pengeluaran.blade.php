@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Pengeluaran
		<small>Informasi mengenai pengeluaran</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-wrench"></i> Data Pengeluaran</a></li>
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
			<a id="myButton" href="#" class="btn btn-primary" onclick="tambahPengeluaran()"><i class="fa fa-plus"></i> Tambah Data</a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
						<th>tanggal</th>
						<th>UJS Kamadjaya</th>
						<th>UJS Data Script</th>
						<th>UJS So Good</th>
            <th>Storing</th>
            <th>Lainnya</th>
            <th>Keterangan</th>
            <th>Total Pengeluaran</th>
            <th>Pemasukan</th>
            <th>aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formpengeluaran')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  var t = $('#table').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.pengeluaran') }}",
    'dataType'    : 'json',
    'paging'      : true,
    'lengthChange': true,
    'columns'     : [
      // {data:'id', name: 'id', orderable: false, searchable: false},
      {data:'tanggal', name: 'tanggal'},
      {data:'ujskamadjaya', name: 'ujskamadjaya'},
      {data:'ujsdatascript', name: 'ujsdatascript'},
      {data:'ujssogood', name: 'ujssogood'},
      {data:'storing', name: 'storing'},
      {data:'lain',name:'lain'},
      {data:'keterangan',name:'keterangan'},
      {data:'total',name:'total'},
      {data:'pemasukan',name:'pemasukan'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahPengeluaran(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#myModal').modal('show');
    $('#myModal form')[0].reset();
    $('.modal-title').text('Tambah data pengeluaran hari ini');
    $('label[for=storing]').html('Storing hari ini');
  }

  function editPengeluaran(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#myModal form')[0].reset();
    // $('#datepicker').attr('disabled',false);

    $.ajax({
      url: "{{url('pengeluaran')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#myModal').modal('show');
        $('.modal-title').text('Edit data pengeluaran');

        $('#id').val(data['pengeluaran'].id);
        $('label[for=storing]').html('Storing tanggal '+data['pengeluaran'].tanggal);
        $('#datepicker').val(data['pengeluaran'].tanggal);
        $('#ujskamadjaya').val(data['pengeluaran'].ujskamadjaya);
        $('#ujsdatascript').val(data['pengeluaran'].ujsdatascript);
        $('#ujssogood').val(data['pengeluaran'].ujssogood);
        $('#storing').val(data['pengeluaran'].storing);
        $('#lain').val(data['pengeluaran'].lain);
        $('#keterangan').val(data['pengeluaran'].keterangan);
        $('#pemasukan').val(data['pengeluaran'].pemasukan);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deletePengeluaran(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('pengeluaran') }}" + '/' + id,
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
    if(save_method == 'add') url = "{{url('pengeluaran')}}";
    else url = "{{url('pengeluaran').'/'}}" + id;

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
