<!DOCTYPE html>
<html lang="en">

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

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">

    <div class="app-wrapper">

@include('layout.header')

@include('layout.sidebar')

@yield('content')

    </div>

@include('layout.cdn.js')
@stack('scripts')
@yield('script')
</body>

</html>
