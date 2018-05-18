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
      <br>
			<a id="myButton" href="#" class="btn btn-primary" onclick="tambahPengeluaran()"><i class="fa fa-plus"></i> Tambah Data</a>

      <!-- Expot/Import Button -->
      <div class="pull-right">
        <a id="import-btn" href="#" class="btn btn-info"><i class="fa fa-upload"></i> Import</a>
        <a href="{{route('pengeluaran.export')}}" class=" btn btn-info" style=""><i class="fa fa-download"></i> Export</a>
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
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Pengeluaran</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button onclick="refresh()" type="button" class="btn btn-box-tool" id="refresh"><i class="fa fa-refresh"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="chart" id="chart">
        <canvas id="barChart" style="height:450px"></canvas>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
</section>
@include('form/formpengeluaran')
@include('form/importpengeluaran')
<!-- ChartJS -->
<script src="{{asset('admin/bower_components/chart.js/Chart.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
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
        $('#datepicker').val(data['tanggal_']);
        $('#tanggal').val(data['tanggal_']);
        $('#ujskamadjaya').val(data['pengeluaran'].ujskamadjaya);
        $('#ujsdatascript').val(data['pengeluaran'].ujsdatascript);
        $('#ujssogood').val(data['pengeluaran'].ujssogood);
        $('#storing').val(data['storing']);
        $('#storing_').val(data['storing']);
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
<script>
  var urlChart = "{{url('pengeluaran/chart')}}";
  var dataPengeluaran = {{$chart}};
  var dataBulan = {!!$bulan!!};
  var areaChartData = {
    labels  : dataBulan,
    datasets: [
      {
        label               : 'Pengeluaran',
        fillColor           : '#dd4b39',
        strokeColor         : null,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : dataPengeluaran
      }
    ]
  }
  var barChartCanvas = $('#barChart').get(0).getContext('2d');
  var barChart = new Chart(barChartCanvas);
  var barChartData = areaChartData;
  var barChartOptions = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero        : true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : true,
    //String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    //Boolean - If there is a stroke on each bar
    barShowStroke           : true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth          : 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing         : 5,
    //Number - Spacing between data sets within X values
    barDatasetSpacing       : 1,
    //String - A legend template
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive              : true,
    maintainAspectRatio     : true
  }

  barChartOptions.datasetFill = false;
  barChart.Bar(barChartData, barChartOptions);
  function refresh(){
    barChart.Bar(barChartData, barChartOptions);
  }
</script>
@endsection
