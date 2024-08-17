<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Mikrotik</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form method="post" action="{{route('postmikrotik')}}">
        <div class="modal-body">
           
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlInput1">IP Address / VPN Remote </label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="127.0.0.1 / vpn.xxx.xxx" name="ipmikrotik">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Username</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username Mikrotik" name="usernamemikrotik">
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password Mikrotik" name="passwordmikrotik">
                  </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Port Service Mikirotik</label>
                  <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Default 8728" name="portmikrotik">

                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Catatan</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Catatan" name="catatan">
                </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

      </div>
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="tambahOLT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah OLT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{route('postolt')}}">
      <div class="modal-body">
         
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">IP Address / VPN Remote </label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="127.0.0.1:xxxx / vpn.xxx.xxx:xxxx" name="ipolt">
              </div>

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Catatan</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Catatan" name="catatan">
              </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
  </form>

    </div>
  </div>
</div>
