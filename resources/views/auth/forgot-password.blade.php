@extends('frontend.mainmaster')

@section('content')
        <div class="ps-page--product ps-page--product1 forgetpass">
            <div class="container mt-5">
                <div class="ps-page__content">
                    <div class="auth-wrap">
                        <div class="row">
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                            @endif

                            <x-jet-validation-errors class="mb-4 validation-error-block" />

                            <form method="POST" action="{{ route('password.email') }}" class="block w-100">
                                @csrf

                                <div class="block">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <!-- <x-jet-button>
                                        {{ __('Email Password Reset Link') }}
                                    </x-jet-button> -->
                                    <button class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection