@extends('layouts.master2')
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">

                                <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                            src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                                            class="sign-favicon ht-40" alt="logo"></a>
                                    <h3 class="m-2">إدارة صيانة محطات التحويل
                                        الرئيسية</h5>
                                </div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2 class="text-dark">مرحبا بك</h2>
                                        <h5 class="font-weight-semibold mb-4">تسجيل الدخول</h5>
                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-4" :status="session('status')" />

                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />
                                        @auth
                                            @php
                                                $is_admin = Auth::user()->is_admin ? 'admin' : 'user';
                                            @endphp
                                        @endauth
                                        @if (!Auth::check())
                                            <form method="post" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label>البريد الالكتروني</label>
                                                    <x-input id="email" class="form-control" type="email" name="email"
                                                        :value="old('email')" required autofocus />
                                                </div>
                                                <div class="form-group">
                                                    <label>كلمة المرور</label>
                                                    <x-input id="password" class="form-control" type="password"
                                                        name="password" required autocomplete="current-password" />
                                                </div><button class="btn btn-dark btn-block">تسجيل الدخول</button>
                                                <!-- Remember Me -->
                                                <div class="block mt-4">
                                                    <label for="remember_me" class="inline-flex items-center">
                                                        <input id="remember_me" type="checkbox"
                                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                            name="remember">
                                                        <span
                                                            class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                                    </label>
                                                </div>
                                            </form>
                                        @else
                                            @switch($is_admin)
                                                @case('user')
                                                    <a class="btn btn-outline-dark p-3 d-block"
                                                        href="/dashboard/user/query_section_id={{ Auth::user()->section_id }}">
                                                        الدخول للصفحة الرئيسية</a>
                                                @break

                                                @case('admin')
                                                    <a class="btn btn-outline-dark p-3 d-block"
                                                        href="/dashboard/admin/query_section_id={{ Auth::user()->section_id }}">
                                                        الدخول للصفحة الرئيسية</a>
                                                @break
                                            @endswitch
                                        @endif

                                        <div class="flex items-center justify-end mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('هل نسيت كلمة المرور؟') }}
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-dark">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">

                    </div>
                </div>
            </div>

        </div><!-- End -->
    </div>
    </div>
@endsection
@section('js')
@endsection
