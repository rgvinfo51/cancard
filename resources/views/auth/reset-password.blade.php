@extends('frontend.mainmaster')

@section('content')
        <div class="ps-page--product ps-page--product1 resetpassword">
            <div class="container mt-5">
                <div class="ps-page__content">
                    <div class="auth-wrap">
                        <div class="row">
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Reset your Password') }}
                            </div>

                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                            @endif

                            <x-jet-validation-errors class="mb-4 validation-error-block" />

                            <form method="POST" action="{{ route('password.update') }}" class="block w-100">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="block">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <button class="btn btn-primary">{{ __('Reset Password') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
