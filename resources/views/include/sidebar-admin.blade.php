<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BukuTamu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
          <a href="#" class="d-block"> 
            @if (count($nmarray) == 1)
            {{ $nmarray[0]}}
            @else
            {{ $nmarray[0]." ".$nmarray[1] }}
            @endif
            </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('pengunjung.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Pengunjung
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('barang.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('acara.index') }}" class="nav-link">
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