<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(#eaed36, #F26D20);">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{asset('assets/img/LOGO_TERBIT-removebg-preview.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; height: 50px; width: 50px;">
      <span class="brand-text font-weight-bold" style="color: black; ">Terbit</span>
    </a>

    <!-- Sidebar -->
<div class="sidebar" >
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">    
        <div class="image">
          <img src="{{asset('assets/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- <a href="#" class="d-block">Aziz Maulana Hakim</a> -->
          @auth
           @if (Auth::check())
           <div class="info">
            <a class="d-block"  href="{{ route('profile.edit') }}" style="color: black;">{{ strtoupper(Auth::user()->name) ?? "" }}</a>
            <span  class="text-primary">Role: {{Auth::user()->role}}</span>
           </div>
           @endif
           @endauth
           @guest
           <a href="#" class="d-block">Guest</a>
           @endguest
        </div>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
              <a style="color: black;" href="{{ url('dashboard') }}" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                      Halaman Utama
                  </p>
              </a>
          </li>
          <!-- <li class="nav-item">
                <a style="color: black;" href="{{ url('profil') }}" class="nav-link">
                      <i class="nav-icon fas fa-user-alt"></i>
                      <p>
                          Profile
                      </p>
                  </a>
              </li> -->
              <li class="nav-item">
                  <a style="color: black;" href="{{ url('laporan/show') }}" class="nav-link">
                      <i class="nav-icon fas fa-clipboard-list"></i> <!-- Ganti ikon dengan clipboard-list -->
                      <p>
                          Laporan Progres
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a style="color: black;" href="{{ url('/manajemen') }}" class="nav-link">
                      <i class="nav-icon fas fa-tasks"></i> <!-- Ganti ikon dengan tasks -->
                      <p>
                          Manajemen Tugas
                      </p>
                  </a>
              </li>
              <li class="nav-item">
              <a style="color: black;" href="{{ route('jadwals.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-calendar-alt"></i> <!-- Ganti ikon dengan calendar -->
                  <p>
                      Jadwal Bimbingan
                  </p>
              </a>
          </li>

              <li class="nav-item">
                  <a style="color: black;" href="{{ url('timer/show') }}" class="nav-link">
                      <i class="nav-icon fas fa-bullseye"></i> <!-- Ganti ikon dengan bullseye -->
                      <p>
                          Mode Fokus
                      </p>
                  </a>
              </li>

          <li class="nav-item">
              <a style="color: black;" href="{{ route('logout') }}" class="nav-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-user"></i>Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>