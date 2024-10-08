<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li class=active><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
              </ul>
            </li>
         
            <li class="menu-header">Stisla</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i> <span>Mikrotik</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-lin beep beep-sidebar" href="#" data-toggle="modal" data-target="#exampleModal">Tambah Mikrotik</a></li>
                <li><a class="nav-lin beep beep-sidebar" href="{{route('carimikrotik')}}">Client Mikrotik</a></li>                
                <li><a class="nav-lin beep beep-sidebar" href="{{route('datamikrotik')}}">Data Mikrotik</a></li>                

            </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i> <span>OLT</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-lin beep beep-sidebar" href="#" data-toggle="modal" data-target="#tambahOLT">Tambah OLT</a></li>           
                <li><a class="nav-lin beep beep-sidebar" href="{{route('cariolt')}}">Cari OLT</a></li>                

            </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-route"></i> <span>IP</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-lin beep beep-sidebar" href="{{route('carimikrotikneighbor')}}">Neighbor</a></li>                
                <li><a class="nav-lin beep beep-sidebar" href="{{route('cariinterface')}}">Interface</a></li>                

            </ul>
            </li>
          
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-atom"></i> <span>Settings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-lin beep beep-sidebar" href="{{route('carishcedule')}}">Schedule</a></li>                

            </ul>
            </li>

          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Documentation
            </a>
          </div>        
        </aside>
      </div>
