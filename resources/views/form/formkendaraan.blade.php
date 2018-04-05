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
              <label class="control-label col-sm-2" for="nopol">No Polisi:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nopol" id="nopol" placeholder="Masukan nomor polisi">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="stnk">No STNK:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="stnk" id="stnk" placeholder="Masukan nomor STNK">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tahun">Tahun:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Masukan tahun">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="merk">Merk:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="merk" id="merk" placeholder="Masukan merk">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="daerah">Daerah:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="daerah" id="daerah" placeholder="Masukan daerah">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="foto">Foto:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="foto" id="foto" placeholder="Masukan foto">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kir">No kir:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kir" id="kir" placeholder="Masukan nomor kir">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sipa">No sipa:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sipa" id="sipa" placeholder="Masukan sipa">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="ibm">No ibm:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="ibm" id="ibm" placeholder="Masukan nomor ibm">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kiu">No kiu:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="kiu" id="kiu" placeholder="Masukan nomor kiu">
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
