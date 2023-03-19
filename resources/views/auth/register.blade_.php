@extends('frontend.mainmaster')

@section('content')
        <div class="ps-home ps-home--8 registerarea">
            <div class="ps-home__content">
                <div class="auth-wrap">
                    <div class="row">
                        <div class='col-md-12'>
                            <h3>Register</h3>
                        </div>
                        <div class='col-md-12'>
                            <x-jet-validation-errors class="mb-4 validation-error-block" />
                            <form method="POST" action="{{ route('customregister') }}">
                                @csrf

                                <div>
                                    <x-jet-label for="name" value="{{ __('Contact Name*') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <div>
                                    <x-jet-label for="posttitle" value="{{ __('Title/Role*') }}" />
                                    <x-jet-input id="posttitle" class="block mt-1 w-full" type="text" name="posttitle" :value="old('posttitle')" required autofocus autocomplete="posttitle" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="email" value="{{ __('Email*') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>
                                
                                <div>
                                    <x-jet-label for="phoneno" value="{{ __('Phone No*') }}" />
                                    <x-jet-input id="phoneno" class="block mt-1 w-full" type="text" name="phoneno" :value="old('phoneno')" required autofocus autocomplete="phoneno" />
                                </div>
                                    <div class="mt-4">
                                        <x-jet-label for="company" value="{{ __('Company Name*') }}" />
                                        <x-jet-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required autofocus autocomplete="company" />
                                    </div>
                                    <div class="mt-4">
                                        <x-jet-label for="bill_address1" value="{{ __('Address 1*') }}" />
                                        <x-jet-input id="corporateaddress" class="block mt-1 w-full" type="text" name="bill_address1" :value="old('bill_address1')" required autofocus autocomplete="bill_address1" />
                                    </div>
                                    <div class="mt-4">
                                        <x-jet-label for="corporateaddress" value="{{ __('Address 2*') }}" />
                                        <x-jet-input id="bill_address2" class="block mt-1 w-full" type="text" name="bill_address2" :value="old('bill_address2')" required autofocus autocomplete="bill_address2" />
                                    </div>
                                    
                                    <div class="mt-4">
                                        <x-jet-label for="city" value="{{ __('City*') }}" />
                                        <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
                                    </div>
                                    
                                    <div class="mt-4">
                                        <x-jet-label for="country" value="{{ __('Country*') }}" />
                                        <select required id="country" class="block mt-1 w-full" name="country" onchange="fetchProvince(this.value)">
                                            <option value="Canada">Canada</option>
                                            <option value="USA">USA</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <x-jet-label for="province" value="{{ __('Province*') }}" />
                                        <select required id="province" class="block mt-1 w-full" type="text" name="province">
                                            <option value="Alberta">Alberta</option>
                                            <option value="British Columbia">British Columbia</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                            <option value="Nova Scotia">Nova Scotia</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="Prince Edward Island">Prince Edward Island</option>
                                            <option value="Quebec">Quebec</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Northwest Territories">Northwest Territories</option>
                                            <option value="Nunavut">Nunavut</option>
                                            <option value="Yukon">Yukon</option>
                                        </select>
                                    </div>
                                    
                                
                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password*') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mt-4">
                                        <x-jet-label for="terms">
                                            <div class="flex items-center">
                                                <x-jet-checkbox name="terms" id="terms"/>

                                                <div class="ml-2">
                                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </x-jet-label>
                                    </div>
                                @endif

                                <div class="d-flex align-items-center justify-content-between mt-4">
                                    <a class="link-text" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <!-- <x-jet-button class="ml-4">
                                        {{ __('Register') }}
                                    </x-jet-button> -->
                                    <button class="btn btn-primary">{{ __('Register') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="d-none" id="usa_province">
                <option value="Alabama">Alabama</option>
                <option value="Alaska">Alaska</option>
                <option value="Arizona">Arizona</option>
                <option value="Arkansas">Arkansas</option>
                <option value="California">California</option>
                <option value="Colorado">Colorado</option>
                <option value="Connecticut">Connecticut</option>
                <option value="Delaware">Delaware</option>
                <option value="District Of Columbia">District Of Columbia</option>
                <option value="Florida">Florida</option>
                <option value="Georgia">Georgia</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Idaho">Idaho</option>
                <option value="Illinois">Illinois</option>
                <option value="Indiana">Indiana</option>
                <option value="Iowa">Iowa</option>
                <option value="Kansas">Kansas</option>
                <option value="Kentucky">Kentucky</option>
                <option value="Louisiana">Louisiana</option>
                <option value="Maine">Maine</option>
                <option value="Maryland">Maryland</option>
                <option value="Massachusetts">Massachusetts</option>
                <option value="Michigan">Michigan</option>
                <option value="Minnesota">Minnesota</option>
                <option value="Mississippi">Mississippi</option>
                <option value="Missouri">Missouri</option>
                <option value="Montana">Montana</option>
                <option value="Nebraska">Nebraska</option>
                <option value="Nevada">Nevada</option>
                <option value="New Hampshire">New Hampshire</option>
                <option value="New Jersey">New Jersey</option>
                <option value="New Mexico">New Mexico</option>
                <option value="New York">New York</option>
                <option value="North Carolina">North Carolina</option>
                <option value="North Dakota">North Dakota</option>
                <option value="Ohio">Ohio</option>
                <option value="Oklahoma">Oklahoma</option>
                <option value="Oregon">Oregon</option>
                <option value="Pennsylvania">Pennsylvania</option>
                <option value="Rhode Island">Rhode Island</option>
                <option value="South Carolina">South Carolina</option>
                <option value="South Dakota">South Dakota</option>
                <option value="Tennessee">Tennessee</option>
                <option value="Texas">Texas</option>
                <option value="Utah">Utah</option>
                <option value="Vermont">Vermont</option>
                <option value="Virginia">Virginia</option>
                <option value="Washington">Washington</option>
                <option value="West Virginia">West Virginia</option>
                <option value="Wisconsin">Wisconsin</option>
                <option value="Wyoming">Wyoming</option>
        </div>

        <div class="d-none" id="canada_province">
            <option value="Alberta">Alberta</option>
            <option value="British Columbia">British Columbia</option>
            <option value="Manitoba">Manitoba</option>
            <option value="New Brunswick">New Brunswick</option>
            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
            <option value="Nova Scotia">Nova Scotia</option>
            <option value="Ontario">Ontario</option>
            <option value="Prince Edward Island">Prince Edward Island</option>
            <option value="Quebec">Quebec</option>
            <option value="Saskatchewan">Saskatchewan</option>
            <option value="Northwest Territories">Northwest Territories</option>
            <option value="Nunavut">Nunavut</option>
            <option value="Yukon">Yukon</option>
        </div>


         <script>

            function removeError(){
             $('label[for=billing_address]').removeClass('text-danger'); 
             $('label[for=shipping_address]').removeClass('text-danger');
             $("#error_address").text("");
            }

            function fetchProvince(value){
                 if(value=='USA'){
                     $("#province").html($("#usa_province").html());
                 }
                 if(value=='Canada'){
                     $("#province").html($("#canada_province").html());
                 }
            }
        </script>
@endsection