<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>BASE TEMPLATE</title>
        <link rel="shortcut icon" href="{{ asset('assets/img/SRA.ico') }}">

        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="hold-transition">

        <div class="w-screen min-h-screen flex justify-center items-center bg-[linear-gradient(45deg,_#5a605d_0%,_#00061c_100%)]">
            <div class="w-full text-sm flex justify-center">
                @yield('content')
            </div>
        </div>

        <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
        @yield('script')
    </body>
</html>