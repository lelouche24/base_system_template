@extends('login.app')

@section('content')
    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
        <div class="hidden bg-cover lg:block lg:w-1/2"
            style="background-image: url('https://images.unsplash.com/photo-1606660265514-358ebbadc80d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1575&q=80');">
        </div>

        <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
            <div class="flex justify-center mx-auto">
                <h1 class="text-2xl sm:text-2xl font-bold text-gray-800 dark:text-gray-200">
                    Base Template System
                </h1>
            </div>

            <p class="mt-3 text-sm text-center text-gray-600 dark:text-gray-200">
                Sign in to access your account
            </p>

            <div class="mt-2">
                @if(Session::has('AUTH_AUTHENTICATED'))
                    {!! __html::alert('danger', 'Oops!', Session::get('AUTH_AUTHENTICATED')) !!}
                @endif
                @if(Session::has('AUTH_UNACTIVATED'))
                    {!! __html::alert('danger', 'Oops!', Session::get('AUTH_UNACTIVATED')) !!}
                @endif

                @if(Session::has('CHECK_UNAUTHENTICATED'))
                    {!! __html::alert('danger', 'Oops!', Session::get('CHECK_UNAUTHENTICATED')) !!}
                @endif

                @if(Session::has('CHECK_NOT_LOGGED_IN'))
                    {!! __html::alert('danger', 'Oops!', Session::get('CHECK_NOT_LOGGED_IN')) !!}
                @endif

                @if(Session::has('CHECK_NOT_ACTIVE'))
                    {!! __html::alert('danger', 'Oops!', Session::get('CHECK_NOT_ACTIVE')) !!}
                @endif

                @if(Session::has('PROFILE_UPDATE_USERNAME_SUCCESS'))
                    {!! __html::alert('success', 'Success!', Session::get('PROFILE_UPDATE_USERNAME_SUCCESS')) !!}
                @endif

                @if(Session::has('PROFILE_UPDATE_PASSWORD_SUCCESS'))
                    {!! __html::alert('success', 'Success!', Session::get('PROFILE_UPDATE_PASSWORD_SUCCESS')) !!}
                @endif
                @if(Session::has('PASSWORD_RESET_SUCCESS'))
                    {!! __html::alert('success', 'Success!', Session::get('PASSWORD_RESET_SUCCESS')) !!}
                @endif
                @if(Session::has('PASSWORD_RESET_FAILED'))
                    {!! __html::alert('danger', 'Success!', Session::get('PASSWORD_RESET_FAILED')) !!}
                @endif
            </div>

            <form action="{{ route('AUTH.LOGIN') }}" method="POST" id="FORM-LOGIN">
                @csrf
                <div class="mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="username">Username</label>
                    <input type="text" name="username" id="username"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                        value="{{ BaseService::html_attribute_encode(old('username')) }}"
                        autocomplete="off" required/>
                    @if ($errors->has('username'))
                        <span class="text-red-600 text-sm">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"
                            for="password">Password</label>
                        <a href="#" class="text-xs text-gray-500 dark:text-gray-300 hover:underline">Forget Password?</a>
                    </div>

                    <input  type="password" name="password" id="password"
                        class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300"
                       autocomplete="off" required/>
                    @if ($errors->has('password'))
                        <span class="text-red-600 text-sm">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mt-8">
                    <button
                        class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-800 rounded-lg hover:bg-sky-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="px-4 py-3 text-center text-xs text-gray-600 sm:flex sm:justify-between sm:items-center">
                <p class="mb-2 sm:mb-0">
                    <strong>&copy; 2024 <a href="https://www.sra.gov.ph" class="text-blue-500 hover:underline">SRA</a></strong>.
                    All rights reserved.
                </p>
                <div class="hidden sm:block text-right">
                    <b>Version</b> 1.0
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert-auto-dismiss').forEach(el => el.remove());
    }, 3000); // 3 seconds
</script>
@endsection