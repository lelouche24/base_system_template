        <nav class="app-header navbar navbar-expand bg-body" data-bs-theme="">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> --}}
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search">
                            <span class="direct-chat-name float-start">
                                {{  Auth::guard('admin')->user()->fullname }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                            <a href="{{ url('admin/logout') }}" class="dropdown-item fw-bold">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                            </a>
                        </div>
                </ul>

            </div>
        </nav>
