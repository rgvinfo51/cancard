@extends('frontend.mainmaster')
@section('content')

<main class="main-container">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con address-profile-con">
                <h2 class="mt-5">Shipping Address</h2>
                 @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                 @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form method="post" action="{{route('shippingaddress.update')}}">
                @csrf
                    <input type="hidden" name="province" value="">
                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">First Name</span>
                            <input type="text" name="ship_firstname" value="{{ $customerdata['ship_firstname'] }}">
                            @if ($errors->has('ship_firstname'))
                                <span class="text-danger">{{ $errors->first('ship_firstname') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Last Name</span>
                            <input type="text" name="ship_lastname" value="{{ $customerdata['ship_lastname'] }}">
                            @if ($errors->has('ship_lastname'))
                                <span class="text-danger">{{ $errors->first('ship_lastname') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">Street address</span>
                            <input type="text" name="ship_address1" value="{{ $customerdata['ship_address1'] }}" >
                            @if ($errors->has('ship_address1'))
                                <span class="text-danger">{{ $errors->first('ship_address1') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Apartment, suite, unit,etc (Optional)</span>
                            <input type="text" name="ship_address2" value="{{ $customerdata['ship_address2'] }}" >
                            @if ($errors->has('ship_address2'))
                                <span class="text-danger">{{ $errors->first('ship_address2') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">Town / City</span>
                            <input type="text" name="ship_city" value="{{ $customerdata['ship_city'] }}">
                            @if ($errors->has('ship_city'))
                                <span class="text-danger">{{ $errors->first('ship_city') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Postal code</span>
                            <input type="text" name="ship_zipcode" value="{{ $customerdata['ship_zipcode'] }}">
                            @if ($errors->has('ship_zipcode'))
                                <span class="text-danger">{{ $errors->first('ship_zipcode') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">Country</span>
                             <input type="text" name="ship_country" value="{{ $customerdata['ship_country'] }}" >
                            @if ($errors->has('ship_country'))
                                <span class="text-danger">{{ $errors->first('ship_country') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                        </div>
                    </div>
                    
                    <div class="submit-savechanges">
                        <input class="submit-savechanges" type="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
@endsection