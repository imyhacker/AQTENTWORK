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
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Lokasi Mikrotik</th>
                                <th>IP / VPN Mikrotik</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($dm as $data)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$data->catatan}}</td>
                                    <td>{{$data->ipmikrotik}}</td>
                                    <td>{{$data->usernamemikrotik}}</td>
                                    <td>                <span class="password-field" data-password="{{$data->passwordmikrotik}}">********</span>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
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
  @include('sweetalert::alert') <!-- Tambahkan ini sebelum tag penutup body -->

<x-dcore.script />