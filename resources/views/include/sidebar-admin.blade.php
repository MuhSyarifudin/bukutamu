<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <center>
        <img src="{{ url('dist/img/logo-landscape.png') }}" alt="bukutamu Logo" title="Bukutamu Logo" style="width: 200px;height: 50px" style="opacity: .8">      
      </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 pt-4 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        @php
          $nama = Auth::user()->name;
          $nmarray = explode(' ',$nama);
          $sdbrarray = explode(' ',$title,-1);
          $sidebar_active = ucwords(preg_replace('/-/m', ' ', $title));
        @endphp
        <div class="info">
          <a href="{{ route('profile.edit') }}" class="d-block"> 
            @if (count($nmarray) == 1)
            {{ $nmarray[0]}}
            @else
            {{ $nmarray[0]." ".$nmarray[1] }}
            @endif
            </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ $active_menu == 'dashboard' ? 'active' : '' }}">
                  <i class="fas fa-tachometer-alt ml-1"></i>
                  <p class="ml-2">Dashboard</p>
                </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pengunjung.index') }}" class="nav-link {{ $active_menu == 'pengunjung' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengunjung
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('barang.index') }}" class="nav-link {{ $active_menu == 'barang' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('acara.index') }}" class="nav-link {{ $active_menu == 'acara' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Acara
              </p>
            </a>
          </li>
        </ul>
      </nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>