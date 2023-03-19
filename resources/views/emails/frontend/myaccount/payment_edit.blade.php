@extends('frontend.mainmaster')
@section('content')

<main class="main-container profilearea">
    <div class="myaccount-wrap">
        <div class="container">
            <div class="myaccount-content-block">    
                @include('frontend.myaccount.leftsidebar')

                <div class="right-con address-profile-con">
                    <h2>Payment Setting</h2>
                    @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show col-10" style="font-size: 21px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show col-10" style="font-size: 21px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    <div class="edit-form shadow-lg px-5 py-3" style="border-radius: 8px !important;">
                        <form action="{{route('updatepayment')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$paymentsetting->id}}">
                            <div class="form-row row">
                                <div class="col-12 form-group required mb-3">
                                    <label class="control-label" for="name">Name on Card</label> 
                                    <input class="form-control" value="{{$paymentsetting->name}}" name="name" id="name" placeholder="Name" size="4" type="text" required>
                                </div>
                            </div>

                            <div class="form-row row">
                                <div class="col-12 form-group required mb-3">
                                    <label class="control-label" for="card_number">Card Number</label> <input autocomplete="off" class="form-control card-num" value="{{$paymentsetting->card_number}}" placeholder="XXXX XXXX XXXX XXXX" name="card_number" id="card_number" size="20" type="number" required>
                                </div>
                            </div>

                            <div class="form-row row">
                                <div class="col-xs-12 col-md-3 form-group cvc required mb-3">
                                    <label class="control-label font-12" for="cvv">CVC</label> <input autocomplete="off" class="form-control card-cvc" value="{{$paymentsetting->cvv}}" placeholder="ex. 311" size="4" type="number" name="cvv" id="cvv" required>
                                </div>
                                <div class="col-xs-12 col-md-3 form-group expiration required mb-3">
                                    <label class="control-label font-12" for="expiration_month">Expiration
                                    Month</label> <input value="{{$paymentsetting->expiration_month}}" class="form-control card-expiry-month" placeholder="MM" size="2" type="number" name="expiration_month" id="expiration_month" required>
                                </div>
                                <div class="col-xs-12 col-md-3 form-group expiration required mb-3">
                                    <label class="control-label font-12" for="expiration_year">Expiration Year</label>
                                    <input value="{{$paymentsetting->expiration_year}}" class="form-control card-expiry-year" placeholder="YYYY" size="4" type="number" name="expiration_year" id="expiration_year" required>
                                </div>
                                <div class="col-xs-12 col-md-3 form-group expiration required mt-5 pt-4 pl-5">
                                    <div class="form-check">
                                        <label class="form-check-label_" for="defaultCheck1">
                                            <input @if($paymentsetting->set_default==1) {{'checked'}} @else {{''}} @endif class="form-check-input_" type="checkbox" name="set_default" value="1" id="defaultCheck1" style="height: 20px;width: 26px;"><span style="position: absolute;">Default Payment</span>
                                        <!-- <input @if($paymentsetting->set_default==1) {{'checked'}} @else {{''}} @endif class="form-check-input" type="checkbox" name="set_default" value="1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Default Payment
                                        </label> -->
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary" name="update">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection