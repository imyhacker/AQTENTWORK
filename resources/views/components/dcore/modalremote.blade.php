<!-- Remote Modem Modal -->
<div class="modal fade" id="RemoteModem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remote Modem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="remoteModemForm" action="{{ route('remotemodem', $slugcatatan) }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="ipAddress">IP Address</label>
            <input type="text" class="form-control" id="ipAddress" name="ipaddr" placeholder="127.x.x.x" readonly="true">
          </div>
         
          <div class="form-group">
            <label for="exampleFormControlSelect1">PORT</label>
            <select class="form-control" id="exampleFormControlSelect1" id="port" name="toport">
              <option disabled selected value>- PILIH PORT -</option>
              <option value="443">443</option>
              <option value="80">80</option>
              <option value="8080">8080</option>
            </select>
            <small  class="mini-text">Modem : 80, Tenda : 80</small>

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
