<div class="row" style="font-size: 11px !important;">
    <div class="col-12 col-sm-6 mb-2">
        <label class="fw-bold">Name<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="menuName_create" id="menuName_create" autocomplete="off"
            placeholder="Name">
    </div>
    <div class="col-12 col-sm-6 mb-2">
        <label class="fw-bold">Route<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="menuRoute_create" id="menuRoute_create" autocomplete="off"
            placeholder="Route">
    </div>
    <div class="col-12 col-sm-6 mb-2">
        <label class="fw-bold">Category<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="menuCategory_create" id="menuCategory_create" autocomplete="off"
            placeholder="Category">
    </div>
    <div class="col-12 col-sm-6 mb-2">
        <label for="portal" class="text-bold">Portal<span class="text-danger"> *</span></label>
        <select class="custom-select form-control-border rounded-0" name="menuPortal_create" id="menuPortal_create">
            <option value="" selected>Select</option>
            <option value="Admin">Admin</option>
            <option value="Acctg">Accounting</option>
        </select>
    </div>
    <div class="col-12 col-sm-6 mb-2">
        <label class="fw-bold">Icon</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white" id="icon-preview" style="min-width: 30px; text-align: center; font-size: 18px;">
                    <i class="fas fa-question"></i>
                </span>
            </div>
            <input type="text" class="form-control rounded-0" name="icon" id="icon" autocomplete="off"
                placeholder="e.g., fas fa-user" aria-describedby="icon-preview">
        </div>
        <small class="form-text text-muted">Enter Font Awesome class name, e.g., <code>fas fa-user</code></small>
    </div>

    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">Is Menu<span class="text-danger"> *</span></label>
        <div class="icheck-primary">
            <input type="checkbox" name="is_menu_create" id="is_menu_create" value="1">
            <label for="is_menu_create">
                Yes
            </label>
        </div>
    </div>

    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">Is Dropdown</label>
        <div class="icheck-primary">
            <input type="checkbox" name="is_dropdown_create" id="is_dropdown_create" value="1">
            <label for="is_dropdown_create">
                Yes
            </label>
        </div>
    </div>

    {{-- <div class="col-12 mb-2">
    <span class="text-bold bg-navy rounded-0 d-block text-center py-2 mb-2">Auto include known submenus</span>
        <label class="fw-bold">Submenus</label>
        <div class="row">
            @foreach (Helper::knownSubmenus() as $submenuKey => $submenuLabel)
                <div class="col-2">
                    <div class="icheck-primary">
                        <input type="checkbox" name="submenus[]" id="submenu_{{ $submenuKey }}"
                            value="{{ $submenuKey }}">
                        <label for="submenu_{{ $submenuKey }}">
                            {{ $submenuLabel }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
</div>