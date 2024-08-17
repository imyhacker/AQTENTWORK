
<div class="modal fade" id="RemoteModem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remote Modem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" action="{{route('remotemodem', $slugcatatan)}}">
      <div class="modal-body">
         
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Ip Address</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="127.x.x.x" name="ipaddr">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">PORT</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="443, 80, 8080 " name="toport">
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