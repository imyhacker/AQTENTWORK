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
                    <form method="post" action="{{route('caridataolt')}}">
                      @csrf
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Cari OLT</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="slugcatatan">
                            <option disable selected value>- CARI OLT -</option>
                            @foreach ($do as $data)
                            <option value="{{$data->slugcatatan}}">{{$data->catatan}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Cari OLT</button>
                        </div>
                       
                      </form>
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