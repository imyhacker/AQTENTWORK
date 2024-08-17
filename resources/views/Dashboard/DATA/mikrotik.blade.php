<x-dcore.head />
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <x-dcore.nav />
      <x-dcore.sidebar />

      <div class="main-content">
       
        <section class="section">

        <!-- MAIN OF CENTER CONTENT -->
          <div class="row">

            <div class="col-lg-12">
              <div class="card">
              
                <div class="card-body">
                    <table id="myTable" class="table">
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
                                <td>{{$no++}}</td>
                                <td>{{$d['.id']}}</td>
                                <td>{{$d['name']}}</td>
                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#">Remote Alat</a>
                                      <a class="dropdown-item" href="#">Remote Modem</a>
                                      <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                  </div>
                                </td>
                                <td>{{$d['service']}}</td>
                                <td>{{$d['address']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            
          </div>
        <!-- END OF CENTER CONTENT -->


        </section>
      </div>
      <x-dcore.footer />
      <x-dcore.modaltambah />

    </div>
  </div>
<x-dcore.script />