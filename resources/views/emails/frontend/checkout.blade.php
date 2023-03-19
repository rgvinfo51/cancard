@extends('frontend.mainmaster')
@section('content')

 <style>
        .font-12 {
            font-size: 12px !important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .default_card{
            border: 1px solid #5ee55e;
        }
    </style>
   
   
<div class="ps-checkout">
    <div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                                <img class="" src="{{ URL::asset('frontend/img/slide1.jpg') }}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">Checkout</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container profilearea checkoutarea">
        
        <!-- <h3 class="ps-checkout__title text-center bg-secondary text-white m-4"> Checkout</h3> -->
        <div class="ps-checkout__content container-fluid">
             @if (Session::has('fail-message'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message') }}</p>
                </div>
            @endif
                  <!-- <div class="ps-checkout__wapper ">
                <p class="ps-checkout__text">Returning customer? <a href="my-account.html">Click here to login</a></p>
                <p class="ps-checkout__text">Have a coupon? <a href="Cart-page.html">Click here to enter your code</a></p>
            </div> -->
                  <form method="post" action="{{route('checkoutstore')}}" enctype="multipart/form-data"
                      class="validation"
                      data-cc-on-file="false"
                      data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                      id="payment-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="ps-checkout__form">
                            <h3 class="ps-checkout__heading">Billing details</h3>
                            <div class="row">
                                @php
                                    if(empty($customerdata))
                                    {
                                        $checkguest=1;
                                        $emailaddress='';
                                        $bfirstname='';
                                        $blastname='';
                                        $companyname='';
                                        $phoneno='';
                                        $bstreetaddress1='';
                                        $bstreetaddress2='';
                                        $bcity='';
                                        $bpostcode='';
                                        $bcountry='';
                                        $sfirstname='';
                                        $slastname='';
                                        $sstreetaddress1='';
                                        $sstreetaddress2='';
                                        $scity='';
                                        $spostcode='';
                                        $scountry='';
                                    }
                                    else{
                                        $checkguest=0;
                                        $emailaddress=$customerdata->email;
                                        $companyname=$customerdata->company;
                                        $phoneno=$customerdata->phoneno;
                                        $bfirstname=$customerdata->bill_firstname;
                                        $blastname=$customerdata->bill_lastname;
                                        $bstreetaddress1=$customerdata->bill_address1;
                                        $bstreetaddress2=$customerdata->bill_address2;
                                        $bcity=$customerdata->bill_city;
                                        $bpostcode=$customerdata->bill_zipcode;
                                        $bcountry=$customerdata->bill_country;
                                        $sfirstname=$customerdata->ship_firstname;
                                        $slastname=$customerdata->ship_lastname;
                                        $sstreetaddress1=$customerdata->ship_address1;
                                        $sstreetaddress2=$customerdata->ship_address2;
                                        $scity=$customerdata->ship_city;
                                        $spostcode=$customerdata->ship_zipcode;
                                        $scountry=$customerdata->ship_country;
                                    }
                                @endphp
                                @if($checkguest)
                                
                                    <div class="col-12">
                                <div class="ps-checkout__group">
                                    <label class="ps-checkout__label">Email address *</label>
                                    <input class="ps-input" type="email" name="email" value="">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                </div>
                                @else
                                <input class="ps-input" type="hidden" name="email" value="{{ $emailaddress }}">
                                @endif
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">First name *</label>
                                        <input class="ps-input" type="text" name="bfirstname"  value="{{ $bfirstname }}">
                                    @if ($errors->has('bfirstname'))
                                        <span class="text-danger">{{ $errors->first('bfirstname') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Last name *</label>
                                        <input class="ps-input" type="text" name="blastname" value="{{ $blastname }}">
                                    @if ($errors->has('blastname'))
                                        <span class="text-danger">{{ $errors->first('blastname') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Company name (optional)</label>
                                        <input class="ps-input" type="text" name="companyname" value="{{ $companyname }}">
                                    @if ($errors->has('companyname'))
                                        <span class="text-danger">{{ $errors->first('companyname') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <input class="ps-input mb-3" type="hidden" name="bstreetaddress1" placeholder="House number and street name" value="{{ $bstreetaddress1 }}">
                                    @if ($errors->has('bstreetaddress1'))
                                        <span class="text-danger">{{ $errors->first('bstreetaddress1') }}</span>
                                    @endif

                                        <input class="ps-input" type="hidden" name="bstreetaddress2" placeholder="Apartment, suite, unit, etc. (optional)" value="{{ $bstreetaddress2 }}">
                                    @if ($errors->has('bstreetaddress2'))
                                        <span class="text-danger">{{ $errors->first('bstreetaddress2') }}</span>
                                    @endif

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <input class="ps-input" type="hidden" name="bcity" value="{{ $bcity }}">
                                    @if ($errors->has('bcity'))
                                        <span class="text-danger">{{ $errors->first('bcity') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <input class="ps-input" type="hidden" name="bpostcode" value="{{ $bpostcode }}">
                                    @if ($errors->has('bpostcode'))
                                        <span class="text-danger">{{ $errors->first('bpostcode') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <input class="ps-input" type="hidden" name="bcountry" value="{{ $bcountry }}">
                                    @if ($errors->has('bcountry'))
                                        <span class="text-danger">{{ $errors->first('bcountry') }}</span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Phone *</label>
                                        <input class="ps-input" type="tel" name="phoneno" value="{{ $phoneno }}">
                                    @if ($errors->has('phoneno'))
                                        <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="create-account">
                                            <label class="form-check-label" for="create-account">Create an account?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 ps-hidden" data-for="create-account">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label ps-label--danger">Create account password *</label>
                                        <div class="input-group">
                                            <input class="form-control ps-input" type="password" placeholder="Password">
                                            <div class="input-group-append"><a class="fa fa-eye-slash toogle-password" href="javascript: vois(0);"></a></div>
                                        </div>
                                    </div>
                                </div>--}}

                                <input type="hidden" name="sstreetaddress1" id="sstreetaddress1" value="{{ (!empty($default_address->address1)) ? $default_address->address1 : '' }}">

                                <input type="hidden" name="sstreetaddress2" id="sstreetaddress2" value="{{ (!empty($default_address->address2)) ? $default_address->address2 : '' }}">

                                <input type="hidden" name="scity" id="scity" value="{{ (!empty($default_address->city)) ? $default_address->city : '' }}">

                                <input type="hidden" name="spostcode" id="spostcode" value="{{ (!empty($default_address->zipcode)) ? $default_address->zipcode : '' }}">
                                
                                <input type="hidden" name="scountry" id="scountry" value="{{ (!empty($default_address->country)) ? $default_address->country : '' }}">
                                <div class="col-12">
                                    <!-- <div class="ps-checkout__group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name='diffrentshipping' id="ship-address" value="1" {{old('diffrentshipping') ? 'checked' : ''}}>
                                            <label class="form-check-label" for="ship-address">Ship to a different address?</label>
                                    @if ($errors->has('diffrentshipping'))
                                        <span class="text-danger">{{ $errors->first('diffrentshipping') }}</span>
                                    @endif
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-12 ps-hidden" data-for="ship-address" style=" {{old('diffrentshipping') ? 'display:block' : ''}}">
                                    <!-- <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">First name *</label>
                                                <input class="ps-input" type="text" name="sfirstname" value="{{ $sfirstname }}">
                                    @if ($errors->has('sfirstname'))
                                        <span class="text-danger">{{ $errors->first('sfirstname') }}</span>
                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Last name *</label>
                                                <input class="ps-input" type="text" name="slastname" value="{{ $slastname }}">
                                    @if ($errors->has('slastname'))
                                        <span class="text-danger">{{ $errors->first('slastname') }}</span>
                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Street address *</label>
                                                <input class="ps-input mb-3" type="text" name="sstreetaddress1" placeholder="House number and street name" value="{{ $sstreetaddress1 }}">
                                    @if ($errors->has('sstreetaddress1'))
                                        <span class="text-danger">{{ $errors->first('sstreetaddress1') }}</span>
                                    @endif

                                                <input class="ps-input" type="text" name="sstreetaddress2" placeholder="Apartment, suite, unit, etc. (optional)" value="{{ $sstreetaddress2 }}">
                                     @if ($errors->has('sstreetaddress2'))
                                        <span class="text-danger">{{ $errors->first('sstreetaddress2') }}</span>
                                    @endif

                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Town / City *</label>
                                                <input class="ps-input" type="text" name="scity" value="{{ $scity }}">
                                    @if ($errors->has('scity'))
                                        <span class="text-danger">{{ $errors->first('scity') }}</span>
                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Postcode *</label>
                                                <input class="ps-input" type="text" name="spostcode" value="{{ $spostcode }}">
                                    @if ($errors->has('spostcode'))
                                        <span class="text-danger">{{ $errors->first('spostcode') }}</span>
                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Country</label>
                                                <input class="ps-input" type="text" name="scountry" value="{{ $scountry }}">
                                    @if ($errors->has('scountry'))
                                        <span class="text-danger">{{ $errors->first('scountry') }}</span>
                                    @endif
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Order notes (optional)</label>
                                        <textarea class="ps-textarea" name="ordernotes" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="saved_address">
                                    <h3><label for="select_card">Your Shipping Address</label></h3>

                                    <!-- @if(!empty($customerdata->ship_address1) || !empty($customerdata->ship_address2))
                                    <label style="cursor: pointer; border-radius: 8px;" class="mx-4 p-3 shadow">
                                        <input onclick="getShippingAddress('{{$customerdata->id}}')" type="radio" name="save_card" style="height: auto;width: auto;">&nbsp; <span style="display: inline;">{{$customerdata->ship_address1 }}</span> <br>
                                         <span style="display: inline;">{{ $customerdata->ship_address2 }}</span> <br>
                                         <span style="display: inline;">{{ $customerdata->ship_city }}</span> <br>
                                         <span style="display: inline;">{{ $customerdata->ship_country }}</span> <br>
                                    </label>
                                    @endif -->

                                        @if(count($payment_methods)>0)
                                            @foreach($addresses as $address)
                                                <label style="cursor: pointer; border-radius: 8px;" class="mx-4 p-3 shadow">
                                                    <input {{ ($address->set_default == 1) ? 'checked' : '' }} onclick="getAddressDetails('{{$address->id}}')" type="radio" name="save_card" style="height: auto;width: auto;">&nbsp;{{$address->address1}} <br>
                                                    @if(!empty($address->address2))
                                                        {{$address->address2}} <br>
                                                    @endif
                                                    {{$address->city}} <br>
                                                    {{$address->country}}
                                                </label>


                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-4 shadow-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="ps-checkout__order">
                            <h3 class="ps-checkout__heading">Your order</h3>
                            <div class="ps-checkout__row">
                                <div class="ps-title">Product</div>
                                <div class="ps-title">Subtotal</div>
                            </div>
                            @foreach($cartitems as $cartitem)
                            <div class="ps-checkout__row ps-product">
                                <div class="ps-product__name">{{$cartitem->productname}} x <span>{{$cartitem->qty}}</span></div>
                                <div class="ps-product__price" translate="no">
                                    @if($cartitem->discountprice!='')
                                                ${{$cartitem->discountprice * $cartitem->qty}}
                                            @else
                                            ${{$cartitem->price * $cartitem->qty}}
                                            @endif
                                </div>
                            </div>
                            @endforeach
                            
                           <!--  <div class="ps-checkout__group mt-2">
                                <label class="ps-checkout__label">P.O Number</label>
                                <input class="ps-input" type="text" name="purchaseno">
                            </div><label class="ps-checkout__label">Or</label>
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Upload P.O </label>
                                <input type="file" id="myFile" name="purchasedoc" class=" ps-input">                            </div>
                            <div class="ps-checkout__row">
                                <div class="ps-title">Subtotal</div>
                                <div class="ps-product__price">${{$carttotals['subtotal']}}</div>
                            </div> -->
                            
                           @if(Session::has('coupon'))
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Coupon({{$carttotals['coupon_name']}})</div>
                                    <div class="ps-product__price" translate="no">${{$carttotals['discount_amount']}}</div>
                                </div>
                            @endif
                           
                            <!--<div class="ps-checkout__row">
                                <div class="ps-title">Shipping</div>
                                <div class="ps-checkout__checkbox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="free-ship" checked>
                                        <label class="form-check-label" for="free-ship">Free shipping</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="price-ship">
                                        <label class="form-check-label" for="price-ship">Local Pickup: <span>$10.00</span></label>
                                    </div>
                                </div>
                            </div>
                                                        <input type="hidden" name="couponcode">
                            <input type="hidden" name="discountamount" value=''>
                            <input type="hidden" name="total_amount">
                            <input type="hidden" name="currency" value='CAD'>

                            -->
                            <div class="ps-checkout__row">
                                <div class="ps-title">Total</div>
                                <div class="ps-product__price" translate="no">${{$carttotals['total_amount']}}</div>
                            </div>
                            <div class="ps-checkout__payment">
                                <!-- <div class="payment-method">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="payment" checked>
                                        <label class="form-check-label" for="payment">Check payments</label>
                                    </div>
                                    <p class="ps-note">Some Noteice Here</p>
                                </div>
                                
                                <div class="paypal-method">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="paypal">
                                        <label class="form-check-label" for="paypal"> PayPal <a href="https://www.paypal.com/uk/webapps/mpp/paypal-popup">- What is PayPal?</a></label>
                                    </div>
                                </div> -->

                                <div class="paypal-method">
                                    <div id="accordion">
                                        <div class="card p-1">
                                            <div class="card-header p-0" id="headingOne">
                                                <h5 class="mb-0">
                                                    <label class="m-0 p-3">
                                                        <input type="radio" name="payment_type" value="Purchase Order"
                                                               style="height: auto;width: auto;"
                                                               data-toggle="collapse"
                                                               data-target="#collapseOne"
                                                               aria-controls="collapseOne" required="">
                                                        Purchase Order
                                                    </label>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                 data-parent="#accordion">
                                                <div class="card-body bg-white">
                                                    <div class="ps-checkout__group mt-2">
                                                        <label class="ps-checkout__label">P.O Number</label>
                                                        <input class="ps-input" type="text" name="purchaseno">
                                                         
                                                    </div>
                                                    <label class="ps-checkout__label">Or</label>
                                                    <div class="ps-checkout__group">
                                                        <label class="ps-checkout__label">Upload P.O </label>
                                                        <input type="file" id="myFile" name="purchasedoc"
                                                               class=" ps-input">
                                                        @if ($errors->has('purchaseno') && $errors->has('purchasedoc'))
                                                            @if ($errors->has('purchaseno') )
                                                                <span class="text-danger">{{ $errors->first('purchaseno') }}</span>
                                                            @endif
                                                        @else
                                                            @if ($errors->has('purchaseno') )
                                                                <span class="text-danger">{{ $errors->first('purchaseno') }}</span>
                                                            @endif
                                                            @if ($errors->has('purchasedoc'))
                                                                <span class="text-danger">{{ $errors->first('purchasedoc') }}</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="ps-checkout__row">
                                                        <div class="ps-title">Subtotal</div>
                                                        <div class="ps-product__price" translate="no">
                                                            ${{$carttotals['subtotal']}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-1">
                                            <div class="card-header p-0" id="headingTwo">
                                                <h5 class="mb-0">

                                                    <label class="m-0 p-3">
                                                        <input type="radio" name="payment_type" value="ONLINE"
                                                               style="height: auto;width: auto;"
                                                               data-toggle="collapse"
                                                               data-target="#collapseTwo"
                                                               aria-controls="collapseTwo">
                                                        Online Payment
                                                    </label>
                                                </h5>
                                            </div>

                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordion">
                                                <div class="card-body bg-white">

                                                    <h3><label for="select_card">Your Save Cards</label></h3>
                                                    <div id="saved_card">
                                                        @if(count($payment_methods)>0)
                                                            @foreach($payment_methods as $payment)
                                                                <label>
                                                                    <table class="table table-borderless shadow" style="border-radius:8px;font-size: 15px !important;">
                                                                        <tr>
                                                                            <th><input onclick="getPaymentDetails('{{$payment['id']}}')" type="radio" name="save_card" style="height: auto;width: auto;"></th>
                                                                            <th>Name On Card</th>
                                                                            <th>{{$payment['name']}}</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>Card Number</th>
                                                                            <th><strong style="color: red;">{{str_pad(substr($payment['card_number'], -4), strlen($payment['card_number']), '*',STR_PAD_LEFT)}}</strong></th>
                                                                        </tr>
                                                                    </table>
                                                                </label>


                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <h3>
                                                        <label for="select_another_card">Card Details</label>
                                                    </h3>

                                                    <div class="shadow p-2" style="border-radius: 8px;" id="another_details">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class='form-row row'>
                                                                    <div class='col-12 form-group required mb-3'>
                                                                        <label class='control-label'>Name on Card</label> <input
                                                                            class='form-control' size='4' type='text' id="name">
                                                                    </div>
                                                                </div>

                                                                <div class='form-row row'>
                                                                    <div class='col-12 form-group required mb-3'>
                                                                        <label class='control-label'>Card Number</label> <input
                                                                            autocomplete='off' class='form-control card-num'
                                                                            placeholder="XXXX XXXX XXXX XXXX"
                                                                            size='20'
                                                                            type='number' id="card_number">
                                                                    </div>
                                                                </div>

                                                                <div class='form-row row'>
                                                                    <div class='col-xs-12 col-md-4 form-group cvc required mb-3'>
                                                                        <label class='control-label font-12'>CVC</label> <input
                                                                            autocomplete='off'
                                                                            class='form-control card-cvc' placeholder='ex. 311'
                                                                            size='4'
                                                                            type='number' id="cvc">
                                                                    </div>
                                                                    <div
                                                                        class='col-xs-12 col-md-4 form-group expiration required mb-3'>
                                                                        <label class='control-label font-12'>Expiration
                                                                            Month</label> <input
                                                                            class='form-control card-expiry-month' placeholder='MM'
                                                                            size='2'
                                                                            type='number' id="expiration_month">
                                                                    </div>
                                                                    <div
                                                                        class='col-xs-12 col-md-4 form-group expiration required mb-3'>
                                                                        <label class='control-label font-12'>Expiration Year</label>
                                                                        <input
                                                                            class='form-control card-expiry-year' placeholder='YYYY'
                                                                            size='4'
                                                                            type='number' id="expiration_year">
                                                                    </div>
                                                                    <div class='col-md-12 hide error form-group d-none'>
                                                                        <div class='alert-danger alert'></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="payment-radio-block">
                                       <!--  <label>
                                            <input type="radio" name="payment_type" value="Purchase Order"> 
                                            Purchase Order
                                        </label> -->
                                        <!--<label>
                                            <input type="radio" name="payment_type" value="Stripe">
                                            Stripe
                                        </label>-->
                                    </div>
                                    <div class="checkPayment selectt">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                    </div>
                                    <div class="paypal selectt">
                                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                                    </div>
                                </div>

                                <div class="check-faq">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agree-faq" checked>
                                        <label class="form-check-label" for="agree-faq"> I have read and agree to the website terms and conditions *</label>
                                    </div>
                                </div>
                                <button class="ps-btn ps-btn--warning "type="submit">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

 <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var $form = $(".validation");
            $('form.validation').bind('submit', function (e) {
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');
                $errorStatus.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        $errorStatus.removeClass('d-none');
                        e.preventDefault();
                    }
                });
               var paymentType =  $('input[name="payment_type"]:checked').val();

                if (!$form.data('cc-on-file') && paymentType==='ONLINE') {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }else {
                    $form.get(0).submit();
                }

            });

            function stripeHandleResponse(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });

    </script>

    <script>
        function getPaymentDetails(id){
            $.ajax({
              type: "POST",
              url: "{{route('get.checkout.single',"+id+")}}",
              data : {
                    'id' : id,
                    '_token' : '{{csrf_token()}}',
               },
              cache: false,
              success: function(response){
                $("#name").val(response['name']);
                $("#card_number").val(response['card_number']);
                $("#expiration_month").val(response['expiration_month']);
                $("#expiration_year").val(response['expiration_year']);
                $("#cvc").prop('required',true);
              }
            });
        }

        function getAddressDetails(id){
            $.ajax({
              type: "POST",
              url: "{{route('get.checkout.single.address',"+id+")}}",
              data : {
                    'id' : id,
                    '_token' : '{{csrf_token()}}',
               },
              cache: false,
              success: function(response){
                $("#sstreetaddress1").val(response['address1']);
                $("#sstreetaddress2").val(response['address2']);
                $("#scity").val(response['city']);
                $("#spostcode").val(response['zipcode']);
                $("#scountry").val(response['country']);
              }
            });
        }

        function getShippingAddress(id){
            $.ajax({
              type: "POST",
              url: "{{route('get.checkout.shipping.address',"+id+")}}",
              data : {
                    'id' : id,
                    '_token' : '{{csrf_token()}}',
               },
              cache: false,
              success: function(response){
                $("#sstreetaddress1").val(response['ship_address1']);
                $("#sstreetaddress2").val(response['ship_address2']);
                $("#scity").val(response['ship_city']);
                $("#spostcode").val(response['ship_zipcode']);
                $("#scountry").val(response['ship_country']);
              }
            });
        }
    </script>
<!--<script type="text/javascript" src="{{ URL::asset('frontend/js/jquery.validate.min.js') }}"></script>-->
@endsection