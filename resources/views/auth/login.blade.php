@extends('frontend.mainmaster')

@section('content')
        <div class="ps-page--product ps-page--product1 loginpage">
            <div class="container mt-5">
                <div class="ps-page__content">
                    <div class="auth-wrap">
                        <div class="row">
                            <div class='col-md-12'>
                                <h3>Login</h3>
                            </div>
                            <div class='col-md-12'>
                                @if (session()->has('notification'))
                                    <div class="notification">
                                        {!! session('notification') !!}
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif
                                <x-jet-validation-errors class="mb-4 validation-error-block" />

                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{route('customlogin')}}">
                                    @csrf
                                    <div>
                                        <x-jet-label for="email" value="{{ __('Email/Customer ID') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
                                    </div>

                                    <div class="mt-4">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                    </div>

                                    <div class="d-flex align-item-center justify-content-between mt-4">
                                        <div class="remember-block">
                                            <label for="remember_me" class="d-flex align-items-center w-100">
                                                <x-jet-checkbox id="remember_me" name="remember" class="input-checkbox" />
                                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                        <div class="forgot-psw-block">
                                            @if (Route::has('password.request'))
                                                <a class="link-text" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mt-4">
                                        <!-- @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif -->

                                        <!-- <x-jet-button class="ml-4">
                                            {{ __('Login') }}
                                        </x-jet-button> -->
                                        <div class="login-btn-block">
                                            <button class="btn btn-primary">{{ __('Login') }}</button>
                                        </div>
                                        <div class="register-btn-block ml-3">
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="registerlink btn btn-secondary w-100">Register</a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="mt-4 register-link">
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="registerlink btn btn-secondary w-100">Register</a>
                                        @endif
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection