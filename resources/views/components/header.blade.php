
    <!-- Left navbar links -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link">HOME</a>
        </li>
    </ul>


    @if(session('alert'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('alert') }}
    </div>
@endif
   
</nav>
