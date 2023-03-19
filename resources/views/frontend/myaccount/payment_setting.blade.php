@extends('frontend.mainmaster')
@section('content')

<main class="main-container profilearea">
    <div class="myaccount-wrap">
        <div class="container">
            <div class="myaccount-content-block">    
                @include('frontend.myaccount.leftsidebar')

                <div class="right-con address-profile-con">
                    <h2 class="m-0 p-0">
                        <div class="row">
                            <div class="col-8">Payment Setting</div>
                            <div class="col-4">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Payment Method</button>
                            </div>
                        </div>
                    </h2>
                    <p>Your saved Credit/Debit Cards</p>
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
                    
                    <div class="">
                        <table class="orders-program-con table table-bordered">
                            <thead style="border-bottom: black 1px solid;">
                                <tr>
                                    <th style="font-weight: bold;">Name On Card</th>
                                    <th style="font-weight: bold;">Card Number</th>
                                    <th style="font-weight: bold;">CVV</th>
                                    <th style="font-weight: bold;">Expiration Month</th>
                                    <th style="font-weight: bold;">Expiration Year</th>
                                    <th style="font-weight: bold;" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($paymentsetting) > 0)
                                 @foreach($paymentsetting as $payment)
                                 <tr>
                                     <th>{{$payment->name}}</th>
                                     <th>{{str_pad(substr($payment->card_number, -4), strlen($payment->card_number), 'x',STR_PAD_LEFT)}}</th>
                                     <th>{{preg_replace("/[\S]/", "x", $payment->cvv)}}</th>
                                     <th>{{$payment->expiration_month}}</th>
                                     <th>{{$payment->expiration_year}}</th>
                                     <th><a href="{{route('editpayment',$payment->id)}}" style="color: #005dab;">Edit</a></th>
                                     <th><a href="{{route('deletepayment',$payment->id)}}" class="text-danger">Delete</a></th>
                                 </tr>
                                 @endforeach
                                @else
                                <tr>
                                    <th colspan="7" style="text-align: center !important;">No data available in the table</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Credit/Debit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div class="card-body bg-white">
                    <form action="{{route('addpaymentsetting')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$customerdata->id}}">
                        <div class="form-row row">
                            <div class="col-12 form-group required mb-3">
                                <label class="control-label" for="name">Name on Card</label> 
                                <input class="form-control" name="name" id="name" placeholder="Name" size="4" type="text" required>
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="col-12 form-group required mb-3">
                                <label class="control-label" for="card_number">Card Number</label> <input autocomplete="off" class="form-control card-num" placeholder="XXXX XXXX XXXX XXXX" name="card_number" id="card_number" size="20" type="number" required>
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="col-xs-12 col-md-3 form-group cvc required mb-3">
                                <label class="control-label font-12" for="cvv">CVV</label> <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="number" name="cvv" id="cvv" required>
                            </div>

                            <div class="col-xs-12 col-md-3 form-group expiration required mb-3">
                                <label class="control-label font-12" for="expiration_month">Expiration
                                Month</label> <input class="form-control card-expiry-month" placeholder="MM" size="2" type="number" name="expiration_month" id="expiration_month" required>
                            </div>

                            <div class="col-xs-12 col-md-3 form-group expiration required mb-3">
                                <label class="control-label font-12" for="expiration_year">Expiration Year</label>
                                <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="number" name="expiration_year" id="expiration_year" required>
                            </div>

                            <div class="col-xs-12 col-md-3 form-group expiration required mt-5 pt-4 pl-5">
                                <div class="form-check">
                                    
                                    <label class="form-check-label_" for="defaultCheck1">
                                        <input class="form-check-input_" type="checkbox" name="set_default" value="1" id="defaultCheck1" style="height: 20px;width: 26px;"><span style="position: absolute;">Default Payment</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection