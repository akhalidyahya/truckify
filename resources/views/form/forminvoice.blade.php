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
          <form id="form-invoice" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}} {{method_field('POST')}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label class="control-label col-sm-2" for="no">No Invoice:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="no" id="no" placeholder="Masukan nomor invoice">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nominal">Nominal</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nominal" id="nominal" placeholder="Masukan nominal">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_invoice">Tanggal Invoice:</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tgl_invoice" type="text" class="datepicker form-control pull-right" id="tgl_invoice">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_tempo">Jatuh Tempo:</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tgl_tempo" type="text" class="datepicker form-control pull-right" id="tgl_tempo">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_do">DO s/d tanggal:</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tgl_do" type="text" class="datepicker form-control pull-right" id="tgl_do">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_bayar">tanggal bayar:</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="tgl_bayar" type="text" class="datepicker form-control pull-right" id="tgl_bayar">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="logistik">Logistik</label>
              <div class="col-sm-10">
                <select class="form-control" name="logistik" id="logistik">
                  <option value="">--pilih logistik--</option>
                  <option value="Kamadjaya">Kamadjaya</option>
                  <option value="Data Script">Data Script</option>
                  <option value="So Good">So Good</option>
                </select>
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
