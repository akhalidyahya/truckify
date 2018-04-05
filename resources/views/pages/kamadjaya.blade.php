@extends('layout.app')
@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<section class="content-header">
	<h1>
		Project Kamadjaya
		<small>Informasi mengenai project Kamadjaya</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-wrench"></i> Project Kamadjaya</a></li>
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
			<a id="myButton" href="#" class="btn btn-primary" onclick="tambahKamadjaya()"><i class="fa fa-plus"></i> Tambah Data</a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
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
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
@include('form/formkamadjaya')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


@endsection
