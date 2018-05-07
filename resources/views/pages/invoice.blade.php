@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Data Invoice
		<small>Informasi mengenai invoice</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-file-o"></i> Data Invoice</a></li>
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

      <a href="#" class="btn btn-primary" onclick="tambahInvoice()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-info"><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('invoice.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
      </div>
      <!-- END Export/Import Button -->

    </div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>no Invoice</th>
						<th>Nominal</th>
						<th>tanggal Invoice</th>
						<th>Jatuh Tempo</th>
            <th>DO sd tanggal</th>
            <th>tanggal bayar</th>
            <th>logistik</th>
            <th>aksi</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/forminvoice')
@include('form/importinvoice')
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
      'ajax'        : "{{ route('api.invoice') }}",
      'dataType'    : 'json',
      'paging'      : true,
      'lengthChange': true,
      'columns'     : [
        {data:'no', name: 'no'},
        {data:'nominal', name: 'nominal'},
        {data:'tgl_invoice', name: 'tgl_invoice'},
        {data:'tgl_tempo', name: 'tgl_tempo'},
        {data:'tgl_do', name: 'tgl_do'},
        {data:'tgl_bayar', name: 'tgl_bayar'},
        {data:'logistik', name: 'logistik'},
        {data:'aksi', name: 'aksi', orderable: false, searchable: false},
      ],
      'info'        : true,
      'autoWidth'   : false
    });

    function tambahInvoice(){
      save_method = 'add';
      $('input[name=_method]').val('POST');
      $('#myModal').modal('show');
      $('#myModal form')[0].reset();
      $('.modal-title').text('Tambah data Invoice');
    }

    function editInvoice(id){
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      $('#myModal form')[0].reset();
      $.ajax({
        url: "{{url('invoice')}}"+"/"+id+"/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#myModal').modal('show');
          $('.modal-title').text('Edit data invoice');

          $('#id').val(data.id);

          $('#no').val(data.no);
          $('#nominal').val(data.nominal);
          $('#tgl_tempo').val(data.tgl_tempo);
          $('#tgl_invoice').val(data.tgl_invoice);
          $('#tgl_do').val(data.tgl_do);
          $('#tgl_bayar').val(data.tgl_bayar);
          $('#logistik').val(data.logistik);
        },
        error: function(){
          alert("something went wrong!");
        }
      });
    }

    function deleteInvoice(id) {
      var popup = confirm("Apakah ingin hapus data?");
      var csrf_token = $('meta[name="csrf_token"]').attr('content');
      if(popup == true) {
        $.ajax({
          url: "{{ url('invoice') }}" + '/' + id,
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
      if(save_method == 'add') url = "{{url('invoice')}}";
      else url = "{{url('invoice').'/'}}" + id;

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
          $('#myModal').modal('hide');
          $('#error').removeClass('hide');
        }
      });
    });
</script>

@endsection
