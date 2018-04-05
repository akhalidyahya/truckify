<!-- Modal -->
  <div class="modal fade" id="modalUser" role="dialog">
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
              <label class="control-label col-sm-2" for="nama">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama user">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="username">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukan username">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="password">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="role">Role</label>
              <div class="col-sm-10">
                <select id="role" class="form-control" name="role">
                  <option value="pegawai">pegawai</option>
                  <option value="admin">admin</option>
                </select>
              </div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <!-- Modal -->
    <div class="modal fade" id="modalMekanik" role="dialog">
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
                <label class="control-label col-sm-2" for="nama2">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama2" id="nama2" placeholder="Masukan nama Mekanik">
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
