@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data User
		<small>Informasi mengenai pengguna aplikasi</small>
	</h1>
	<ol class="breadcrumb">
    <li><i class="fa fa-wrench"></i> Pengaturan</li>
		<li><i class="fa fa-circle-o"></i> Users</li>
	</ol>
</section>
<section class="content">
	<div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
    		<div class="box-header">
    			<h3 class="box-title">Data Users</h3>
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
    			<a href="#" class="btn btn-primary" onclick="tambahUser()"><i class="fa fa-plus"></i> Tambah User</a>
    		</div>
    		<!-- /.box-header -->
    		<div class="box-body">
    			<table id="example" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>Id</th>
    						<th>nama</th>
    						<th>username</th>
                <th>Role</th>
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
    <!-- <div class="col-md-6">
      <div class="box box-primary">
    		<div class="box-header">
    			<h3 class="box-title">Nama Mekanik</h3>
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
    			<a href="#" class="btn btn-primary" onclick="tambahMekanik()"><i class="fa fa-plus"></i> Tambah Mekanik</a>
    		</div>
    		<div class="box-body">
    			<table id="example2" class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th>Id</th>
    						<th>nama</th>
                <th>aksi</th>
    					</tr>
    				</thead>
    				<tbody></tbody>
    			</table>
    		</div>
    	</div>
    </div> -->
    <!-- ./col-md-6 -->
  </div>
</section>
@include('form/formuser')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
  var table = $('#example').DataTable({
    'processing'  : true,
    'serverSide'  : true,
    'ajax'        : "{{ route('api.user') }}",
    'dataType'    : 'json',
    'searching'   : false,
    'paging'      : true,
    'lengthChange': false,
    'columns'     : [
      {data:'id', name: 'id'},
      {data:'nama', name: 'nama'},
      {data:'username', name: 'username'},
      {data: 'role', name: 'role'},
      {data:'aksi', name: 'aksi', orderable: false, searchable: false},
    ],
    'info'        : true,
    'autoWidth'   : false
  });

  $('#submit').click(function(e){
    e.preventDefault();
    var id = $('#id').val();
    if(save_method == 'add') url = "{{url('users')}}";
    else url = "{{url('users').'/'}}" + id;

    $.ajax({
      url:url,
      type:'POST',
      // data: $('#myModal form').serialize(),
      data: $('#modalUser form').serialize(),
      success: function($data){
        $('#success').removeClass('hide');
        $('#modalUser').modal('hide');
        table.ajax.reload();
      },
      error: function(){
        $('#error').removeClass('hide');
      }
    });
  });

  function tambahUser(){
    save_method = 'add';
    $('input[name=_method]').val('POST');
    $('#modalUser').modal('show');
    $('#modalUser form')[0].reset();
    $('.modal-title').text('Tambah user');
  }

  function editUser(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modalUser form')[0].reset();
    $.ajax({
      url: "{{url('users')}}"+"/"+id+"/edit",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('#modalUser').modal('show');
        $('.modal-title').text('Edit data user');

        $('#id').val(data.id);
        $('#nama').val(data.nama);
        $('#username').val(data.username);
        $('#role').val(data.role);
      },
      error: function(){
        alert("something went wrong!");
      }
    });
  }

  function deleteUser(id) {
    var popup = confirm("Apakah ingin hapus data?");
    var csrf_token = $('meta[name="csrf_token"]').attr('content');
    if(popup == true) {
      $.ajax({
        url: "{{ url('users') }}" + '/' + id,
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
</script>
<script type="text/javascript">
  // var t = $('#example2').DataTable({
  //   'processing'  : true,
  //   'serverSide'  : true,
  //   'ajax'        : "{{ route('api.mekanik') }}",
  //   'dataType'    : 'json',
  //   'searching'   : false,
  //   'paging'      : true,
  //   'lengthChange': false,
  //   'columns'     : [
  //     {data:'id', name: 'id'},
  //     {data:'nama', name: 'nama'},
  //     {data:'aksi', name: 'aksi', orderable: false, searchable: false},
  //   ],
  //   'info'        : true,
  //   'autoWidth'   : false
  // });
  //
  // $('#submit2').click(function(e){
  //   e.preventDefault();
  //   var id = $('#id2').val();
  //   if(save_method == 'add') url = "{{url('users/save')}}";
  //   else url = "{{url('users/improve').'/'}}" + id;
  //
  //   $.ajax({
  //     url:url,
  //     type:'POST',
  //     // data: $('#myModal form').serialize(),
  //     data: $('#modalMekanik form').serialize(),
  //     success: function($data){
  //       $('#success2').removeClass('hide');
  //       $('#modalMekanik').modal('hide');
  //       t.ajax.reload();
  //     },
  //     error: function(){
  //       $('#error2').removeClass('hide');
  //     }
  //   });
  // });
  //
  // function tambahMekanik(){
  //   save_method = 'add';
  //   $('input[name=_method]').val('POST');
  //   $('#modalMekanik').modal('show');
  //   $('#modalMekanik form')[0].reset();
  //   $('.modal-title').text('Tambah mekanik');
  // }
  //
  // function editMekanik(id){
  //   save_method = 'edit';
  //   $('input[name=_method]').val('PATCH');
  //   $('#modalMekanik form')[0].reset();
  //   $.ajax({
  //     url: "{{url('users')}}"+"/"+id+"/change",
  //     type: "GET",
  //     dataType: "JSON",
  //     success: function(data) {
  //       $('#modalMekanik').modal('show');
  //       $('.modal-title').text('Edit data mekanik');
  //
  //       $('#id2').val(data.id);
  //       $('#nama2').val(data.nama);
  //     },
  //     error: function(){
  //       alert("something went wrong!");
  //     }
  //   });
  // }
  //
  // function deleteMekanik(id) {
  //   var popup = confirm("Apakah ingin hapus data?");
  //   var csrf_token = $('meta[name="csrf_token"]').attr('content');
  //   if(popup == true) {
  //     $.ajax({
  //       url: "{{ url('users/delete') }}" + '/' + id,
  //       type: "POST",
  //       data: {'_method': 'DELETE','_token': csrf_token},
  //       success: function(data) {
  //         t.ajax.reload();
  //       },
  //       error: function(){
  //         alert("something went wrong!");
  //       }
  //     });
  //   }
  // }
</script>
@endsection
