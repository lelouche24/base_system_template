@extends('layout.main')
@section('content')  
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-dark btn-sm float-right rounded-0" id="createMenuBtn">
                            <i class="fas fa-plus"></i> Add Menu
                            </button>
                        </div>
                            <div class="col-md-12 mt-2">
                                <table class="table table-striped table-hover table-sm" id="menu_Table">
                                    <thead class="align-middle bg-dark">
                                        <tr>
                                            <th class="text-white">NAME</th>
                                            <th class="text-white">ROUTE</th>
                                            <th class="text-white">SUBMENUS</th>
                                            <th class="text-white">CATEGORY</th>
                                            <th class="text-white">PORTAL</th>
                                            <th class="text-white">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-12">
                                <div id="modal-body">
                                    
                                </div>
                            </div>
                    </div>
                   

@include('menu.js.createMenuJs')
@endsection
