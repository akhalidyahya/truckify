@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Jenis dan Harga
		<small>Informasi mengenai jenis kendaraan dan biaya</small>
	</h1>
	<ol class="breadcrumb">
    <li><i class="fa fa-wrench"></i> Pengaturan</li>
		<li><a href="#"><i class="fa fa-circle-o"></i> Jenis dan harga</a></li>
	</ol>
</section>
<section class="content">
	<div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
    		<div class="box-header">
    			<h3 class="box-title">Harga</h3>
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
          <br><br>
    			<a href="#" class="btn btn-primary" onclick="tambahJenis()"><i class="fa fa-plus"></i> Tambah Harga</a>
    		</div>
    		<!-- /.box-header -->
    		<div class="box-body">
    			<table id="example" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<!-- <th>Id</th> -->
    						<th>jenis</th>
    						<th>daerah</th>
                <th>harga</th>
                <th>aksi</th>
    					</tr>
    				</thead>
    				<tbody></tbody>
    			</table>
    		</div>
    		<!-- /.box-body -->
    	</div>
    </div>
    <!-- /.col-md-6 -->

    <!-- biaya -->
    <div class="col-md-6">
      <div class="box box-primary">
    		<div class="box-header">
    			<h3 class="box-title">Jenis Kendaraan</h3>

          <div id="success2" class="alert alert-success hide" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            Your action was <strong>Successful</strong>
          </div>

          <div id="error2" class="alert alert-danger hide" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            something went <strong>wrong!</strong>
          </div>
          <br><br>
    			<a href="#" class="btn btn-primary" onclick="tambahHarga()"><i class="fa fa-plus"></i> Tambah Jenis</a>
    		</div>

    		<div class="box-body">
    			<table id="example2" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>daerah</th>
                <th>aksi</th>
    					</tr>
    				</thead>
    				<tbody></tbody>
    			</table>
    		</div>

    	</div>
    </div>
    <!-- ./col-md-6 -->
  </div>
</section>
@include('form/formjenis')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  var table = $('#example').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.jenis') }}",
    'dataType'    : 'json',
    'searching'   : false,
    'paging'      : true,
    'lengthChange': false,
    'columns'     : [
      // {data:'id', name: 'id'},
      {data:'jenis_kendaraan', name: 'jenis_kendaraan'},
      {data:'daerah', name: 'daerah'},
      {data: 'harga', name: 'harga'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  function tambahJenis(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#modalJenis').modal('show');
    $('#modalJenis form')[0].reset();
    $('.modal-title').text('Tambah Jenis Kendaraan');
  }

  function editJenis(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modalJenis form')[0].reset();
    $.ajax({
      url: "{{url('jenis')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalJenis').modal('show');
        $('.modal-title').text('Edit data Jenis Kendaraan');

        $('#id').val(data.id);
        $('#jenis_kendaraan').val(data.jenis_kendaraan);
        $('#daerah').val(data.daerah);
        $('#harga').val(data.harga);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteJenis(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('jenis') }}" + '/' + id,
        type: "POST",
        data: {'_method': 'DELETE','_token': csrf_token},
        success: function(data) {
          table.ajax.reload();
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
    if(save_method == 'add') url = "{{url('jenis')}}";
    else url = "{{url('jenis').'/'}}" + id;

    $.ajax({
      url:url,
      type:'POST',
      data: $('#modalJenis form').serialize(),
      success: function($data){
        $('#success').removeClass('hide');
        $('#modalJenis').modal('hide');
        table.ajax.reload();
      },
      error: function(){
        $('#error').removeClass('hide');
      }
    });
  });
</script>
<script>
  var t = $('#example2').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.harga') }}",
    'dataType'    : 'json',
    'searching'   : false,
    'paging'      : true,
    'lengthChange': false,
    'columns'     : [
      {data:'daerah', name: 'daerah'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  $('#submit2').click(function(e){
    e.preventDefault();
    var id = $('#id2').val();
    if(save_method == 'add') url = "{{url('harga/save')}}";
    else url = "{{url('harga/improve').'/'}}" + id;

    $.ajax({
      url:url,
      type:'POST',
      // data: $('#myModal form').serialize(),
      data: $('#modalHarga form').serialize(),
      success: function($data){
        $('#success2').removeClass('hide');
        $('#modalHarga').modal('hide');
        t.ajax.reload();
      },
      error: function(){
        $('#error2').removeClass('hide');
      }
    });
  });

  function tambahHarga(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#modalHarga').modal('show');
    $('#modalHarga form')[0].reset();
    $('.modal-title').text('Tambah data harga');
  }

  function editHarga(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modalHarga form')[0].reset();
    $.ajax({
      url: "{{url('harga')}}"+"/"+id+"/change",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalHarga').modal('show');
        $('.modal-title').text('Edit data mekanik');

        $('#id2').val(data.id);
        $('#daerah2').val(data.daerah);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteHarga(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('harga/delete') }}" + '/' + id,
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
</script>
@endsection
