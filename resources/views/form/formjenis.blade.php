<!-- Modal -->
  <div class="modal fade" id="modalJenis" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form id="form-user" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('POST')}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-sm-3" for="jenis_kendaraan">Jenis Kendaraan</label>
              <div class="col-sm-9">
                <select class="form-control" name="jenis_kendaraan" id="jenis_kendaraan">
                  <option value="">--Pilih--</option>
                  @foreach($jenis as $data)
                  <option value="{{$data->daerah}}">{{$data->daerah}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="daerah">Daerah</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="daerah" id="daerah" placeholder="Masukan Daerah">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="harga">Harga</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan harga">
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


  <!-- Modal -->
    <div class="modal fade" id="modalHarga" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form id="form-mekanik" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
              {{csrf_field()}} {{method_field('POST')}}
              <input type="hidden" name="id2" id="id2">
              <div class="form-group">
                <label class="control-label col-sm-4" for="daerah2">Jenis Kendaraan</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="daerah2" id="daerah2" placeholder="Masukan Jenis Kendaraan">
                </div>
              </div>
              <div class="text-center">
                <button id="submit2" type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
