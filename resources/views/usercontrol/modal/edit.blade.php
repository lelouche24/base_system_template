<div class="row" style="font-size: 11px !important;">
    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">Username<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="username" id="username" autocomplete="off" placeholder="Username" required>
    </div>
    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">Last name<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="lname" id="lname" autocomplete="off" placeholder="Last name" oninput="this.value = this.value.replace(/[^a-zA-Z.'\- ]/g, '');"  required>
    </div>
    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">First name<span class="text-danger"> *</span></label>
        <input type="text" class="form-control rounded-0" name="fname" id="fname" autocomplete="off" placeholder="First name" oninput="this.value = this.value.replace(/[^a-zA-Z.'\- ]/g, '');"  required>
    </div>
    <div class="col-12 col-sm-3 mb-2">
        <label class="fw-bold">Middle initial</label>
        <input type="text" class="form-control rounded-0" name="minitial" id="minitial" autocomplete="off" placeholder="Middle initial" oninput="this.value = this.value.replace(/[^a-zA-Z.'\- ]/g, '');"  maxlength="3">
    </div>
</div>