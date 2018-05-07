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
          <form id="form-pengeluaran" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('POST')}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-sm-3">Tanggal</label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input disabled name="tanggal" type="text" class="form-control pull-right" id="datepicker" value="<?php echo $date = Date('Y-m-d') ?>">
                  <input id="tanggal" type="hidden" name="tanggal" value="{{$date}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="ujskamadjaya">UJS Kamadjaya</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ujskamadjaya" id="ujskamadjaya" placeholder="Masukan pengeluaran ujskamadjaya">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="ujsdatascript">UJS Data Script</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ujsdatascript" id="ujsdatascript" placeholder="Masukan pengeluaran ujsdatascript">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="ujssogood">UJS So Good</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ujssogood" id="ujssogood" placeholder="Masukan pengeluaran ujssogood">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="storing">Storing hari ini</label>
              <div class="col-sm-9">
                <input disabled type="text" class="form-control" name="storing" id="storing" value="{{$storing}}">
                <input type="hidden" name="storing" value="{{$storing}}" id="storing_">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="lain">Lainnya</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="lain" id="lain" placeholder="Masukan pengeluaran lainnya">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="keterangan">Keterangan</label>
              <div class="col-sm-9">
                <textarea name="keterangan" id="keterangan" rows="8" cols="80" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="pemasukan">Pemasukan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="pemasukan" id="pemasukan" placeholder="Masukan pemasukan">
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
