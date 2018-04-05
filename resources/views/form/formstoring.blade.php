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
          <form id="form-kendaraan" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('POST')}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-sm-2">Tanggal storing:</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tanggal" type="text" class="form-control pull-right" id="datepicker">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nopol">Kendaraan</label>
              <div class="col-sm-10">
                <select class="form-control" name="kendaraan" id="kendaraan">
                  <option value="">--pilih kendaraan--</option>
                  @foreach($kendaraan as $data)
                  <option value="{{$data->id}}">{{$data->nopol}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="stnk">Jenis Storing</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Masukan jenis storing">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="biaya">Biaya</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Masukan biaya storing">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="biaya_mekanik">Biaya Mekanik</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="biaya_mekanik" id="biaya_mekanik" placeholder="Masukan biaya mekanik">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nopol">Mekanik</label>
              <div class="col-sm-10">
                <select class="form-control" name="mekanik" id="mekanik">
                  <option value="">--pilih mekanik--</option>
                  @foreach($mekanik as $data)
                  <option value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="foto">Foto:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Masukan foto">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="foto_bon">Foto Bon:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="foto_bon" id="foto_bon" placeholder="Masukan foto bon">
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
