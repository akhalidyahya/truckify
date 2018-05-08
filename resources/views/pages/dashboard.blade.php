@extends('layout.app')
@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>General Info</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-social-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengeluaran <b>Hari</b> Ini</span>
              <span class="info-box-number">Rp. {{$pengeluaranToday}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-social-usd"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengeluaran <b>Bulan</b> Ini</span>
              <span class="info-box-number">Rp. {{$pengeluaranMonth}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="icon ion-android-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Kendaraan</span>
              <span class="info-box-number">{{$kendaraan}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Delivery Cost <br>Kamadjaya <b>Bulan</b> Ini</span>
              <span class="info-box-number">Rp. {{$kamadjaya}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Delivery Cost <br>Datascript <b>Bulan</b> Ini</span>
              <span class="info-box-number">Rp. {{$datascript}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="icon ion-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Delivery Cost <br>So Good <b>Bulan</b> Ini</span>
              <span class="info-box-number">Rp. {{$sogood}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- Default box -->
      <!-- row -->
      <div class="row">
        <div class="col-sm-6">
          <div class="box box-primary">
            <div class="box-header with-border ">
              <h3 class="box-title">Storing</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="nav nav-stacked">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>no</th>
                      <th>Tanggal</th>
                      <th>Kendaraan</th>
                      <th>Jenis Storing</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    @foreach($storing as $data)
                    <tr>
                      <td>{{$no}}</td>
                      <td>{{$data->tanggal}}</td>
                      <td>{{$data->nopol}}</td>
                      <td>{{$data->jenis}}</td>
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                  </tbody>
                </table>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{url('storing')}}">Lihat Selengkapnya</a>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-sm-6 -->
        <div class="col-sm-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              Start creating your amazing application!
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-sm-6 -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
