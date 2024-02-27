<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE | Dashboard v2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE | Dashboard v2">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

@include('layout.cdn.css')
</head>
@include('login.modal.registrationModal')

<body class="login-page bg-body-secondary">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

                {{-- Login Error Message - Start --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {{-- Customer Validation Message - Start --}}
                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                {{-- Customer Validation Message - End --}}
            {{-- Login Error Message - End --}}

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ url('admin/login') }}" method="post"> @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-text">
                            <span class="fa-solid fa-envelope"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-text">
                            <span class="fa-solid fa-lock"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                          <a type="button" class="btn btn-secondary btn-block" id="regBtn">Register</a>
                        </div>
                        <div class="col-4">
                          {{-- <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" @if(isset($_COOKIE["password"])) checked @endif>
                            <label for="remember">
                              Remember Me
                            </label>
                          </div> --}}
                        </div>
                        <div class="col-4">
                          <button type="submit" class="btn btn-primary float-end">Sign In</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </div>
@include('layout.cdn.js')
@include('login.script.loginJS')
@stack('scripts')
@yield('script')
</body>
</html>
