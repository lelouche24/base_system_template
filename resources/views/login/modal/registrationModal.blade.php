<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h1 class="modal-title fs-6 text-white" id="registrationModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="alert alert-danger alert-dismissible fade show alert-sm p-2" role="alert" id="errorContainer">
                <strong style="font-style:italic;">Username already taken.</strong>
            </div>

            <form class="form-rst" id="registrationModalForm" action="javascript:void(0)" method="POST">@csrf

                <input type="hidden" id="registration_id" name="registration_id" class="form-control">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_username">Username</label>
                        <input type="text" class="form-control form-control-sm" id="registration_username" name="registration_username" required placeholder="Username">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_password">Password</label>
                        <input type="password" class="form-control form-control-sm" id="registration_password" name="registration_password" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_firstname">Firstname</label>
                        <input type="text" class="form-control form-control-sm" id="registration_firstname" name="registration_firstname" required placeholder="Firstname">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_middlename">Middlename</label>
                        <input type="text" class="form-control form-control-sm" id="registration_middlename" name="registration_middlename" required placeholder="Middlename">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_lastname">Lastname</label>
                        <input type="text" class="form-control form-control-sm" id="registration_lastname" name="registration_lastname" required placeholder="Lastname">
                    </div>
                    <div class="form-group col-md-6">
                        <label style="font-size: 11pt;" for="registration_position">Position</label>
                        <input type="text" class="form-control form-control-sm" id="registration_position" name="registration_position" required placeholder="Position">
                    </div>
                    <div class="form-group col-md-12">
                        <label style="font-size: 11pt;" for="registration_department">Department</label>
                        <select name="registration_department" id="registration_department" class="form-select form-select-sm" required>
                            <option value="">Select</option>
                            <option value="AFD">ACCOUNTING & FINANCE DIVISION</option>
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
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
        </div>
      </div>
</div>
