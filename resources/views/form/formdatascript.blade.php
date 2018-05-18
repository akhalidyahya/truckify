<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form id="form-datascript" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('POST')}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-sm-3">Tanggal</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tanggal" type="text" class="form-control pull-right" id="datepicker">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="jenis">Tipe Truk</label>
              <div class="col-sm-9">
                <select class="form-control" name="jenis" id="jenis">
                  <option value="">--pilih kendaraan--</option>
                  @foreach($jenis as $data)
                  <option value="{{$data->jenis_kendaraan}}">{{$data->jenis_kendaraan}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="kendaraan">Kendaraan</label>
              <div class="col-sm-9">
                <select class="form-control" name="kendaraan" id="kendaraan">
                  <option value="">--pilih kendaraan--</option>
                  @foreach($kendaraan as $data)
                  <option value="{{$data->id}}">{{$data->nopol}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="no_do">No DO</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="no_do" id="no_do" placeholder="Masukan nomor DO">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="barang">no Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="barang" id="barang" placeholder="Masukan nomor barang">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="customer">Customer</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="customer" id="customer" placeholder="Masukan Customer">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="daerah">daerah</label>
              <div class="col-sm-9">
                <select class="form-control" name="daerah" id="daerah">
                  <option value="">--pilih daerah--</option>
                  @foreach($daerah as $data)
                  <option value="{{$data->daerah}}">{{$data->daerah}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="lain">Biaya Lain</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="lain" id="lain" placeholder="Masukan biaya lain">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="cost">Delivery Cost</label>
              <div class="col-sm-9">
                <!-- <button type="button" name="button" id="hitung">hitung</button> -->
                <b><label class="control-label" id="cost2"></label></b>
                <input type="hidden" class="form-control" name="cost" id="cost" placeholder="Masukan total delivery cost">
              </div>
            </div>
            <div class="text-center">
              <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<script type="text/javascript">
$('#jenis,#daerah').change(function(event){
  event.preventDefault();
  var param = $('#jenis').val();
  var param2 = $('#daerah').val();
  var url = "{{url('datascript/jenis')}}"+"/"+param+"/daerah"+"/"+param2;

  $.ajax({
    url: url,
    type: "GET",
    dataType: "JSON",
    success: function(data) {
      if (data[0] == null) {
        $('#cost').val('harga tidak ditemukan!');
        $('#cost2').text('harga tidak ditemukan!');
      }
      $('#cost').val(data[0].harga);
      $('#cost2').text(data[0].harga);
    },
    error: function(){
      $('#cost').val('harga tidak ditemukan!');
      $('#cost2').text('harga tidak ditemukan!');
    }
  });
});
</script>
