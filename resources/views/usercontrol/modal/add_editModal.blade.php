<div class="modal fade" id="add_edit_userModal" tabindex="-1" aria-labelledby="add_edit_userModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title text-white" id="add_edit_userModalLabel" style="font-size: 14pt; font-weight: bold;">Modal title</h1>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <div class="alert alert-danger alert-dismissible fade show alert-sm p-2" role="alert" id="error-message-container">
                <strong style="font-style:italic;">Username already taken.</strong>
            </div>

            <form class="form-rst" id="add_edit_userModalForm" action="javascript:void(0)" method="POST">@csrf

            <input type="hidden" id="admin_id" name="admin_id">
            <div class="row">
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_username">Username</label>
                    <input type="text" class="form-control form-control-sm" id="admin_username" name="admin_username" required>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_password">Password</label>
                    <input type="password" class="form-control form-control-sm" id="admin_password" name="admin_password">
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_firstname">Firstname</label>
                    <input type="text" class="form-control form-control-sm" id="admin_firstname" name="admin_firstname" required>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_middlename">Middlename</label>
                    <input type="text" class="form-control form-control-sm" id="admin_middlename" name="admin_middlename" required>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_lastname">Lastname</label>
                    <input type="text" class="form-control form-control-sm" id="admin_lastname" name="admin_lastname" required>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_position">Position</label>
                    <input type="text" class="form-control form-control-sm" id="admin_position" name="admin_position" required>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_usertype">User Type</label>
                    <select name="admin_usertype" id="admin_usertype" class="form-control form-select-sm" required>
                        <option value="">Select</option>
                        <option value="superadmin">SUPER ADMIN</option>
                        <option value="admin">ADMIN</option>
                        <option value="user">USER</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label style="font-size: 11pt;" for="admin_department">Department</label>
                    <select name="admin_department" id="admin_department" class="form-control form-select-sm" required>
                        <option value="">Select</option>
                        <option value="AFD">ADMINISTRATIVE & FINANCE DIVISION</option>
                        <option value="QMR">QUALITY MANAGEMENT REPRESENTATIVE</option>
                        <option value="AGRIALLIED">AGRI - ALLIED RESEARCH DIVISION / PRODUCTION TECHNOLOGY AND CROP MANAGEMENT SECTION</option>
                        <option value="EXTENSION">EXTENSION SERVICES</option>
                        <option value="IAD">INTERNAL AUDIT DEPARTMENT</option>
                        <option value="LEGAL">LEGAL DEPARTMENT</option>
                        <option value="FSRD">FACTORY SERVICES AND RESEARCH DIVISION</option>
                        <option value="OOTA">OFFICE OF THE ADMINISTRATOR</option>
                        <option value="OTM">OFFICE OF THE MANAGER III </option>
                        <option value="PPSPD">PLANNING , POLICY & SPECIAL PROJECTS DEPARTMENT</option>
                        <option value="REGULATIONS">REGULATIONS</option>
                    </select>
                </div>
        </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-dark btn-sm">Save</button>
          </div>
        </form>
        </div>
      </div>
</div>

<div class="modal fade" id="edit_userModal" tabindex="-1" aria-labelledby="edit_userModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h1 class="modal-title fs-6 text-white" id="edit_userModalLabel" style="font-size: 14pt; font-weight: bold;">Modal title</h1>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

            <form class="form-rst" id="edit_userModalForm" action="javascript:void(0)" method="POST">@csrf

                <input type="hidden" id="admin_edit_id" name="admin_edit_id" class="form-control form-control-sm">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_username">Username</label>
                        <input type="text" class="form-control form-control-sm" id="admin_edit_username" name="admin_edit_username"  readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_password">Password</label>
                        <input type="password" class="form-control form-control-sm" id="admin_edit_password" name="admin_edit_password" >
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_firstname">Firstname</label>
                        <input type="text" class="form-control form-control-sm" id="admin_edit_firstname" name="admin_edit_firstname" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_middlename">Middlename</label>
                        <input type="text" class="form-control form-control-sm" id="admin_edit_middlename" name="admin_edit_middlename" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_lastname">Lastname</label>
                        <input type="text" class="form-control form-control-sm" id="admin_edit_lastname" name="admin_edit_lastname" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_position">Position</label>
                        <input type="text" class="form-control form-control-sm" id="admin_edit_position" name="admin_edit_position"  required>
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_department">Department</label>
                        <select name="admin_edit_department" id="admin_edit_department" class="form-control form-select-sm" required>
                            <option value="">Select</option>
                            <option value="AFD">ADMINISTRATIVE & FINANCE DIVISION</option>
                            <option value="QMR">QUALITY MANAGEMENT REPRESENTATIVE</option>
                            <option value="AGRIALLIED">AGRI - ALLIED RESEARCH DIVISION / PRODUCTION TECHNOLOGY AND CROP MANAGEMENT SECTION</option>
                            <option value="EXTENSION">EXTENSION SERVICES</option>
                            <option value="IAD">INTERNAL AUDIT DEPARTMENT</option>
                            <option value="LEGAL">LEGAL DEPARTMENT</option>
                            <option value="FSRD">FACTORY SERVICES AND RESEARCH DIVISION</option>
                            <option value="OOTA">OFFICE OF THE ADMINISTRATOR</option>
                            <option value="OTM">OFFICE OF THE MANAGER III </option>
                            <option value="PPSPD">PLANNING , POLICY & SPECIAL PROJECTS DEPARTMENT</option>
                            <option value="REGULATIONS">REGULATIONS</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="admin_edit_usertype">User Type</label>
                        <select name="admin_edit_usertype" id="admin_edit_usertype" class="form-control form-select-sm" required>
                            <option value="superadmin">SUPER ADMIN</option>
                            <option value="admin">ADMIN</option>
                            <option selected value="user">USER</option>
                        </select>
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
          </div>
        </form>
        </div>
      </div>
</div>

<div class="modal fade" id="userStatusModal" tabindex="-1" aria-labelledby="userStatusModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-6 text-white" id="userStatusModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form class="form-rst" id="userStatusModalForm" action="javascript:void(0)" method="POST">@csrf

                <input type="hidden" id="admin_statusID" name="admin_statusID" class="form-control">
                <div class="row">
                    <div class="form-group col-md-6">
                        <select name="admin_status" id="admin_status" class="form-select form-select-sm" required>
                            <option value="1">ACTIVE</option>
                            <option value="0">INACTIVE</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select name="admin_roles" id="admin_roles" class="form-select form-select-sm" required>
                            <option value="1">OFFICER</option>
                            <option value="2">VIEWER</option>
                        </select>
                    </div>
                </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
          </div>
        </form>
        </div>
      </div>
</div>
