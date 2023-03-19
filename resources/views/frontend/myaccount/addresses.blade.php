@extends('frontend.mainmaster')
@section('content')

<style>
    .default{
        background-color: white;color: black;border: 1px solid black;padding: 3px 5px;border-radius: 3px;
    }
</style>

<main class="main-container addressarea">
    <div class="myaccount-wrap">
        <div class="container">
            <div class="myaccount-content-block">
                @include('frontend.myaccount.leftsidebar')

                <div class="right-con addresses-con">
                    <div class="addresses">
                        <div class="clearfix">
                            <div class="float-left"><h2>My Addresses</h2></div>
                            <!-- <div class="float-right"> <h6><a data-toggle="modal" data-target="#myModal" class="btn btn-primary">Add Shipping Address</a></h6></div> -->
                            <div class="float-right"> <h6><a onclick="shippingAddress('add')" class="btn btn-primary">Add Shipping Address</a></h6></div>
                        </div>
                    </div>
                    <!-- <div class="address-main-con">
                        <div class="billing-left">
                            <div class="billing-left-upper">
                                <h3 class="billing-address">Billing address</h3>
                                <span style="color : #024d8d !important;"><span class="default">Default</span></span>
                                <span><a style="color : #024d8d !important;padding-right:5px;" href="{{route('billingaddress')}}"> {{ $billingaddress === 1 ? "Edit" : "Add" }}</a></span>
                            </div>
                            <div class="billing-left-down">
                                @if($billingaddress)
                                <div class="billing-info">
                                    {{ $customerdata->bill_firstname }} {{ $customerdata->bill_lastname }}
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_address1 }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_address2 }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_city }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_zipcode }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_country }} 
                                </div>
                                @else
                                <span class="billing-info">You have not set up this type of address yet. </span>
                                @endif
                            </div>
                        </div>
                        <div class="shipping-right">
                            <div class="shipping-right-upper"> 
                                <h3 class="shipping-address">Shipping Address</h3>
                                <span style="color : #024d8d !important;"><span class="default">Default</span></span>
                                <span><a style="color : #024d8d !important;padding-right:5px;" href="{{route('shippingaddress')}}">{{ $shippingaddress === 1 ? "Edit" : "Add" }}</a></span>
                            </div>
                            <div class="shipping-right-down">
                                @if($shippingaddress)
                                <div class="billing-info">
                                    {{ $customerdata->ship_firstname }} {{ $customerdata->ship_lastname }}
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->ship_address1 }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->ship_address2 }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->ship_city }} 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->ship_zipcode }} 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="billing-info">
                                            {{ $customerdata->ship_country }} 
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                @else
                                <span class="shipping-info">You have not set up this type of address yet. </span>
                                @endif
                            </div>
                        </div>
                    </div> -->
                        <div class="row">

                        <div class="my-4 border ml-4 p-3" style="width:47.5% !important;">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="shipping-address">Billing Address</h3>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <span class="default">Default</span>
                                    </div>
                            </div>
                            <div class="shipping-right-down">
                                <div class="billing-info">
                                    {{ $customerdata->bill_address1 }} &nbsp;
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_address2 }} &nbsp; 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_city }} &nbsp; 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_state }} &nbsp; 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_country }} &nbsp; 
                                </div>
                                <div class="billing-info">
                                    {{ $customerdata->bill_zipcode }} &nbsp; 
                                </div>
                                <div class="billing-info">
                                    &nbsp; 
                                </div>
                                <div class="text-right">
                                    <a style="color : #024d8d !important;padding-right:5px;" href="{{route('billingaddress')}}"> {{ $billingaddress === 1 ? "Edit" : "Add" }}</a>
                                </div>
                            </div>
                        </div>

                        @foreach($addresses as $address)
                                <div class="my-4 border ml-4 p-3" style="width:47.5% !important;">
                                        <div class="row">
                                            <div class="col-10">
                                                <h3 class="shipping-address">Shipping Address</h3>
                                            </div>
                                            <div class="col-md-2">
                                                @if($address['set_default']==1)
                                                    <span class="default">Default</span>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="shipping-right-down">
                                        <div class="billing-info">
                                            {{ $address['address1'] }} 
                                        </div>
                                        <div class="billing-info">
                                            {{ $address['address2'] }} 
                                        </div>
                                        <div class="billing-info">
                                            {{ $address['city'] }} 
                                        </div>
                                        <div class="billing-info">
                                            {{ $address['province'] }} 
                                        </div>
                                        <div class="billing-info">
                                            {{ $address['country'] }} 
                                        </div>
                                        
                                        <div class="billing-info">
                                            {{ $address['zipcode'] }} 
                                        </div>
                                        <div class="text-right">
                                            <a onclick="shippingAddress('edit','{{ $address['id'] }}')" style="color : #024d8d !important;padding-right:5px;cursor: pointer;">Edit</a>|
                                            <a style="color : #024d8d !important;padding-right:5px;cursor: pointer;" onclick="removeShippingAddress('{{ $address['id'] }}','{{ $address['set_default'] }}')">Remove</a>
                                            @if($address['set_default']==0)
                                            <a style="color : #024d8d !important;padding-right:5px;" href="{{route('set.default.addresses',$address['id'])}}">| Set As Default</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade mt-5 pt-5" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="address_edit_add">

            </div>
        </div>
    </div>

    <script>

        function shippingAddress(action,id = ''){
            if(action == 'add'){
                var path = "{{route('add.shipping.more.addresses')}}";
            }
            else{
                var path = "{{route('edit.more.addresses')}}";
            }

            $.ajax({
                type : 'GET',
                data : {
                    'id' : id,
                },
                url : path,
                success : function(response){
                    $("#address_edit_add").html(" ");
                    $("#address_edit_add").html(response);
                    $("#myModal").modal('show');
                },
                error : function(){
                }
            });
        }

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

       function ValidateForm(){
           var country = $("#country").val();
           var zipcode = $("#zipcode").val();
           
           if(country == 'Canada'){
               if(/^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$/.test(zipcode) == false){
                   $("#error_zipcode").show();
                   return false;
               }
               else{
                   $("#error_zipcode").hide();
               }
           }

           if(country == 'USA'){
               if(/(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zipcode) == false){
                   $("#error_zipcode").show();
                   return false;
               }
               else{
                   $("#error_zipcode").hide();
               }
           }

       }

       function removeShippingAddress(address_id,default_address){
        var msg = "Do you want to remove your Shipping Address ?";
        if(default_address ==1){
            msg = "Do you want to remove your Default Shipping Address?";
        }
        if(confirm(msg) == true){
            $.ajax({
                type : 'GET',
                url : "delete-more-address/"+address_id,
                success : function(response){
                    location.reload();
                },
                error : function(){
                }
            });
        }
       }
   </script>
</main>
@endsection