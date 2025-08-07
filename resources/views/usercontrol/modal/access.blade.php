<!-- The modal structure -->
<div class="modal fade" id="ACCESS_MODAL" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between bg-dark">
                <h5 class="modal-title text-white text-bold">USER ACCESS</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_access_form">
                    <input type="hidden" name="slug" value="{{ $user->slug }}">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <span class="text-bold">{{ $user->fullname }}</span>
                            <button class="btn btn-success btn-sm text-bold float-right" type="submit">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>

                        <div class="col-md-2 col-xl-2">
                            <div class="card">
                                <div class="list-group list-group-flush" role="tablist">
                                    @forelse($portals as $portal => $menus)
                                        <a class="list-group-item list-group-item-action count-options {{ $loop->first ? 'active' : '' }}"
                                            data-toggle="list" href="#portal-{{ $loop->iteration }}" role="tab"
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ $portal == '' ? 'SU' : $portal }}
                                            <span class="badge bg-success float-right"></span>
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-xl-10">
                            <div class="tab-content">
                                @forelse ($portals as $portal => $menus)
                                    @php
                                        $groupedByCategory = $menus->sort()->groupBy('menuCategory_create');
                                    @endphp

                                    <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                        id="portal-{{ $loop->iteration }}" role="tabpanel">

                                        <div class="tab tab-vertical">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="nav flex-column nav-tabs h-100" role="tablist"
                                                        aria-orientation="vertical">
                                                        @forelse($groupedByCategory as $category => $menusUnderCategory)
                                                            <a class="nav-link tab-item {{ $loop->first ? 'active' : '' }}"
                                                                data-toggle="pill"
                                                                href="#tab-{{ $loop->parent->iteration }}-{{ $loop->iteration }}"
                                                                role="tab">
                                                                {{ $category }}
                                                                <span class="badge bg-primary float-right ms-3"></span>
                                                            </a>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>

                                                <div class="col-sm-10">
                                                    <div class="tab-content" style="border: none">
                                                        @forelse($groupedByCategory as $category => $menusUnderCategory)
                                                            @php
                                                                $menusUnderCategory = $menusUnderCategory->sortBy(
                                                                    'menuName_create',
                                                                );
                                                            @endphp

                                                            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                                                id="tab-{{ $loop->parent->iteration }}-{{ $loop->iteration }}"
                                                                role="tabpanel">

                                                                <div class="card">
                                                                    <div class="card-header py-0 rounded-0"></div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            @forelse($menusUnderCategory as $menu)
                                                                                <div class="col-sm-4">
                                                                                    <span
                                                                                        class="text-bold bg-dark rounded d-block text-center py-1 mb-1">{{ $menu->menuName_create }}</span>
                                                                                    <select multiple
                                                                                        name="submenus[{{ $menu->menu_id }}][]"
                                                                                        class="form-control select_multiple"
                                                                                        size="10">
                                                                                        @if ($menu->submenu->count() > 0)
                                                                                            @foreach ($menu->submenu as $submenu)
                                                                                                <option
                                                                                                    value="{{ $submenu->submenu_id}}"
                                                                                                    @if (isset($user_submenus_arr[$submenu->submenu_id])) selected @endif>
                                                                                                    {{ $submenu->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            @empty
                                                                            @endforelse
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>