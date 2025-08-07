@extends('layout.main')
@section('content')
    {{-- @include('usercontrol.modal.add_editModal') --}}

            {{-- <table class="table table-striped table-hover table-sm" id="usermanagementTable">
                <thead class="align-middle bg-dark">
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">USERNAME</th>
                        <th style="text-align: center; vertical-align: middle;">FULLNAME</th>
                        <th style="text-align: center; vertical-align: middle;">ACTIVE</th>
                        <th style="text-align: center; vertical-align: middle;">ONLINE</th>
                        <th style="text-align: center; vertical-align: middle">ACTION</th>
                        <th><a type="button" class="btn btn-light btn-sm float-start m-1" style="font-weight: bold;"
                                id="add_edit_userBtn"><i class="fas fa-user-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                </tbody>
            </table> --}}

            <div class="row pt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h3 class="card-title text-bold pt-2">USER LIST</h3>
                            <div class="float-right d-flex align-items-center">
                                <button class="btn btn-light btn-sm me-2 text-dark text-bold rounded-0" id="btn_add">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered TBL_USER" id="TBL_USER"
                                            style="width: 100%; margin:auto; white-space: nowrap !important;">
                                            <thead>
                                                <tr class="text-center align-middle">
                                                    <th>USERNAME</th>
                                                    <th>FULL NAME</th>
                                                    <th>ACTIVE</th>
                                                    <th>ONLINE</th>
                                                    <th>ACTION</th>
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

                <div class="col-12">
                    <div id="modal-body"></div>
                </div>

            </div>

    {{-- @include('usercontrol.script.usermanagementJS') --}}
    @include('usercontrol.script.usermenuScript')
@endsection
