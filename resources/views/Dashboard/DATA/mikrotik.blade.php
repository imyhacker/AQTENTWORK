<x-dcore.head />
<div id="app">
  <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>

    <x-dcore.nav />
    <x-dcore.sidebar />

    <div class="main-content">
      <section class="section">

        <!-- MAIN CONTENT -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Action</th>
                        <th>Type</th>
                        <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $no = 1; @endphp
                      @foreach ($response as $data => $d)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $d['.id'] }}</td>
                          <td>{{ $d['name'] }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $d['.id'] }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $d['.id'] }}">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#RemoteModem" data-ip="{{ $d['address'] }}">Remote Modem</a>
                                <a class="dropdown-item restart-btn" href="{{ route('restartkoneksi', [$slugcatatan, $d['name']]) }}">Restart Koneksi</a>
                                <a class="dropdown-item copy-btn" href="#">Copy IP Address</a>
                              </div>
                            </div>
                          </td>
                          <td>{{ $d['service'] }}</td>
                          <td id="text-to-copy">{{ $d['address'] }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END OF MAIN CONTENT -->

      </section>
    </div>
    <x-dcore.footer />
    <x-dcore.modalremote :slugcatatan="$slugcatatan" />
    <x-dcore.modaltambah />

  </div>
</div>
<x-dcore.script />
