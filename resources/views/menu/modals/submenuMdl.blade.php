<!-- The modal structure -->
<div class="modal fade" id="SUB_MENU_MODAL" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between bg-dark">
                <h5 class="modal-title text-white text-bold">SUB MENU LIST</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="float-right d-flex align-items-center">
                            <a class="btn btn-sm btn-primary border" href="javascript:void(0)"    onclick="submenu_form(null, '{{ route('admin.submenu.store') }}','{{ $menu_id }}')"  data-toggle="tooltip" data-placement="top" title="Edit">
                                    New Record
                                </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="TBL_SUBMENU"
                                style="width: 100%; font-size: 12px; margin:auto; white-space: nowrap !important;">
                                <thead>
                                    <tr class="text-center align-middle">
                                        <th>Name</th>
                                        <th>Nav Name</th>
                                        <th>Route</th>
                                        <th>Is Nav</th>
                                        <th>Users</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="SUB_MENU_FORM_MODAL" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="submenuModalTitle">SUB MENU FORM</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="submenuForm">
                    <input type="hidden" name="slug" id="slug">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-2">
                            <label class="fw-bold">Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control rounded-0" name="name" id="name" autocomplete="off" placeholder="Name">
                        </div>
                        <div class="col-12 col-sm-6 mb-2">
                            <label class="fw-bold">Nav Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control rounded-0" name="nav_name" id="nav_name" autocomplete="off" placeholder="Nav Name">
                        </div>
                        <div class="col-12 col-sm-6 mb-2">
                            <label class="fw-bold">Route<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control rounded-0" name="route" id="route" autocomplete="off" placeholder="Route">
                        </div>
                        <div class="col-12 col-sm-3 mb-2">
                            <label class="fw-bold">Is Nav:</label>
                            <div class="icheck-primary">
                                <input type="checkbox" name="is_nav" id="is_nav" value="1">
                                <label for="is_nav">Yes</label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button id="btn_save_sub" class="btn btn-sm btn-primary text-bold float-right">SAVE</button>
                </div>
            </div>
        </div>
    </div>
</div>

