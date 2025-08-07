        <aside class="main-sidebar bg-dark shadow">
            <div class="sidebar-brand">
                <a class="brand-link">
                    <img src="{{ url('admin/img/SRA.ico') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light text-white" style="font-family: 'Calibri'; font-weight: bold;">BASE
                        TEMPLATE</span>
                </a>
            </div>
            <div class="sidebar">
                <nav class="nav-compact">

                    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview"
                        role="menu" data-accordion="false"
                        style="font-family: 'Calibri'; font-size: 12pt; font-weight: bold;">

                        {{-- <li class="nav-item">
                            <a href="{{ url('admin/dashboard') }}" class="nav-link text-light">
                                <i class="fa fa-hashtag nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link text-light">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Usercontrol</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link text-light">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    User Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/menu') }}" class="nav-link text-light">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Index</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        @if (count($tree) > 0)
                        
                            @php
                                $prioritizedKey = 'MAIN';
                                $tree_copy = [];

                                if (isset($tree[$prioritizedKey])) {
                                    $tree_copy[$prioritizedKey] = $tree[$prioritizedKey];
                                }

                                foreach ($tree as $key => $value) {
                                    if ($key !== $prioritizedKey) {
                                        $tree_copy[$key] = $value;
                                    }
                                }
                            @endphp

                            @foreach ($tree_copy as $category => $menus)
                                @if (count($menus) > 0)
                                    <li class="nav-header" style="font-size: 14px !important;">
                                        {!! Helper::sidenav_labeler($category) !!}
                                    </li>
                                @endif
                                @foreach ($menus as $menu_id => $menu_content)
                                    {{-- {{ dd($menu_content) }} --}}
                                    @if ($menu_content['menu_obj']->is_menu_create == true)
                                        @if ($menu_content['menu_obj']->is_dropdown_create == false)
                                            @if (count($menu_content['submenus']) > 0)
                                                @foreach ($menu_content['submenus'] as $submenu)
                                                    @if ($submenu->is_nav == true)
                                                        <li class="nav-item" style="font-size: 14px !important;">
                                                            <a href="{{ route($submenu->route) }}"
                                                                class="nav-link text-light {{ request()->routeIs($submenu->route) ? 'active' : '' }}">
                                                                <i
                                                                    class="{{ $menu_content['menu_obj']->icon ?? 'fas fa-file-alt' }} nav-icon py-1"></i>
                                                                <p>{!! $submenu->nav_name !!}</p>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            <li class="nav-item {{ request()->routeIs($menu_content['menu_obj']->menuRoute_create . '*') ? 'menu-open' : '' }}"
                                                style="font-size: 14px !important;">
                                                <a href="#" class="nav-link text-light ">
                                                    <i class="nav-icon fas fa-folder-open"></i>
                                                    <p>
                                                        {{ $menu_content['menu_obj']->menuName_create }}
                                                        <i class="right fas fa-angle-left"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    @if (count($menu_content['submenus']) > 0)
                                                        @foreach ($menu_content['submenus'] as $submenu)
                                                            @if ($submenu->is_nav == true)
                                                                <li class="nav-item">
                                                                    <a class="nav-link text-light {{ request()->routeIs($submenu->route) ? 'active' : '' }}"
                                                                        href="{{ route($submenu->route) }}">
                                                                        <i class="fas fa-caret-right nav-icon"></i>
                                                                        <p>{!! $submenu->nav_name !!}</p>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>
