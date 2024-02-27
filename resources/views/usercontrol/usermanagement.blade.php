@extends('layout.main')
@section('content')
@include('usercontrol.modal.add_editModal')
<main class="app-main" style="background-color: rgb(255, 245, 237)">
            <div class="app-content">

                <div class="container-fluid">
                    <div class="col-md-12 mt-2">
                        <table class="table table-striped table-hover table-sm small" id="usermanagementTable">
                            <thead class="align-middle bg-success">
                                <tr>
                                    <th class="text-white">USERNAME</th>
                                    <th class="text-white">FULLNAME</th>
                                    <th class="text-white">DEPARTMENT</th>
                                    <th class="text-white">POSITION</th>
                                    <th class="text-white">USER TYPE</th>
                                    <th class="text-white text-center">STATUS</th>
                                    <th class="text-white text-center">ACTION</th>
                                    <th><a type="button" class="btn btn-warning btn-sm float-start m-1" style="font-weight: bold;" id="add_edit_userBtn"><i class="fa-solid fa-user-plus"></i></a></th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                            </tbody>
                        </table>
                    </div>
            </div>
        </main>
@include('usercontrol.script.usermanagementJS')
@endsection
