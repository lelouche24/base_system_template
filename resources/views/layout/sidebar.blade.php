        <aside class="app-sidebar bg-body-tertiary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="#" class="brand-link">
                    <img src="{{ url('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">AdminLTE 4</span>
                </a>
            </div>
            <div class="sidebar-wrapper fw-bold">
                <nav class="mt-2">

                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                        @if(Session::get('page')=="dashboard")
                        @php $active="active bg-secondary-subtle" @endphp
                        @else
                        @php $active="" @endphp
                        @endif

                        <li class="nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                            <i class="fa-solid fa-table-columns"></i>
                              <p>
                                Dashboard
                              </p>
                            </a>
                          </li>

                        @if(Session::get('page')=="usercontrol")
                        @php $active="active bg-secondary-subtle" @endphp
                        @else
                        @php $active="" @endphp
                        @endif

                        <li class="nav-item">
                            <a href="{{ url('admin/usercontrol') }}" class="nav-link {{ $active }}">
                            <i class="fa-solid fa-user-gear"></i>
                              <p>
                                Usercontrol
                              </p>
                            </a>
                          </li>

                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>
                                    Placeholder
                                    <i class="nav-arrow fa-solid fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../../index.html" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Placeholder v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index2.html" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Placeholder v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index3.html" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Placeholder v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


