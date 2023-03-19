@extends('frontend.mainmaster')

@section('content')
        <div class="ps-page--product ps-page--product1">
            <div class="container mt-5">
                <div class="ps-page__content">
                    <div class="auth-wrap">
                        <div class="row">
                            <div class="mb-4 text-sm text-gray-600 col-md-12">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>
                            <div class="col-md-12">
                                <x-jet-validation-errors class="mb-4 validation-error-block" />

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf
                                    <div>
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                                    </div>

                                    <div class="flex justify-end mt-4">
                                        <!-- <x-jet-button class="ml-4">
                                            {{ __('Confirm') }}
                                        </x-jet-button> -->
                                        <button class="btn btn-primary">{{ __('Confirm') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection