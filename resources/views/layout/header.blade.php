<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          {{-- <span class="dropdown-item dropdown-header">JAMES ALEX BENOSA</span>
          <div class="dropdown-divider"></div> --}}
          {{-- <a href="#" class="dropdown-item text-center">
            <span class="text-muted text-sm">PROFILE</span>
          </a> --}}
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              {{-- <img src="{{ url('admin/img/SRA.ico') }}" alt="User Avatar" class="img-circle" style="width: 10%;"> --}}
              <div class="media-body">
                <h3 class="dropdown-item-title text-dark text-bold">
                     {{  Auth::user()->fullname }}
                  <span class="float-right text-sm text-success"><i class="fas fa-circle"></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('AUTH.logout') }}" class="dropdown-item dropdown-footer text-bold">LOGOUT <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
      </li>
    </ul>
  </nav>
