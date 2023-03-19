<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/skote-django/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Apr 2021 10:20:53 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Cancard Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public') }}/backend/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ asset('public') }}/backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('public') }}/backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('public') }}/backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="auth-logo">
                                            <a href="index.html" class="auth-logo-light">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="{{ asset('public') }}/backend/assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                                                    </span>
                                                </div>
                                            </a>

                                            <a href="index.html" class="auth-logo-dark">
                                                <div class="avatar-md profile-user-wid mb-4">
                                                    <span class="avatar-title rounded-circle bg-light">
                                                        <img src="{{ asset('public') }}/backend/assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                
                                <div class="p-2">
                                    <x-jet-validation-errors class="mb-4" />
                                      @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
                                        @csrf

                                        <div>
                                            <x-jet-label class="form-label" for="email" value="{{ __('Email') }}" />
                                            <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter Email"/>
                                        </div>

                                        <div class="mt-4">
                                            <x-jet-label class="form-label" for="password" value="{{ __('Password') }}" />
                                            <div class="input-group auth-pass-inputgroup">
                                            <x-jet-input id="password" class="form-control" placeholder="Enter password" type="password" name="password" required autocomplete="current-password" aria-label="Password" aria-describedby="password-addon"/>
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                        <div class="block mt-4">
                                            <label for="remember_me" class="flex items-center">
                                                <x-jet-checkbox id="remember_me" name="remember" />
                                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                        <div class="mt-3 d-grid">
                                            <x-jet-button class="btn btn-primary waves-effect waves-light">
                                                {{ __('Login') }}
                                            </x-jet-button>
                                        </div>
            
                                        <div class="mt-4 text-center">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                            @endif
                                        </div>   
                                        
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="{{ asset('public') }}/backend/assets/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('public') }}/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('public') }}/backend/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="{{ asset('public') }}/backend/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('public') }}/backend/assets/libs/node-waves/waves.min.js"></script>
        
        <!-- App js -->
        <script src="{{ asset('public') }}/backend/assets/js/app.js"></script>
    </body>

<!-- Mirrored from themesbrand.com/skote-django/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Apr 2021 10:20:53 GMT -->
</html>
