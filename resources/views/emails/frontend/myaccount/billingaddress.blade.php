@extends('frontend.mainmaster')
@section('content')

<main class="main-container billingaddressarea">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con address-profile-con">
                <h2>Billing Address</h2>
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
                <form method="post" action="{{route('billingaddress.update')}}" onsubmit="return ValidateForm()">
                @csrf
                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">First Name</span>
                            <input type="text" required name="bill_firstname" value="{{ $customerdata['bill_firstname'] }}">
                            @if ($errors->has('bill_firstname'))
                                <span class="text-danger">{{ $errors->first('bill_firstname') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Last Name</span>
                            <input type="text" required name="bill_lastname" value="{{ $customerdata['bill_lastname'] }}">
                            @if ($errors->has('bill_lastname'))
                                <span class="text-danger">{{ $errors->first('bill_lastname') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">Address 1</span>
                            <input type="text" required name="bill_address1" value="{{ $customerdata['bill_address1'] }}" >
                            @if ($errors->has('bill_address1'))
                                <span class="text-danger">{{ $errors->first('bill_address1') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Address 2</span>
                            <input type="text" name="bill_address2" value="{{ $customerdata['bill_address2'] }}" >
                            @if ($errors->has('bill_address2'))
                                <span class="text-danger">{{ $errors->first('bill_address2') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">City</span>
                            <input type="text" required name="bill_city" value="{{ $customerdata['bill_city'] }}">
                            @if ($errors->has('bill_city'))
                                <span class="text-danger">{{ $errors->first('bill_city') }}</span>
                            @endif
                        </div>
                        <div class="address-one-con">
                            <span class="input-name">Country</span>
                            <select name="bill_country" id="country" onchange="fetchProvince(this.value)" required style="font-size: 16px;padding: 0px;padding-left: 5px;">
                                <option @if($customerdata['bill_country']=='Canada') {{'selected'}} @endif value="Canada">Canada</option>
                                <option @if($customerdata['bill_country']=='USA') {{'selected'}} @endif value="USA">USA</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="first-last-name-con">
                        <div class="address-one-con">
                            <span class="input-name">Province</span>
                            <select name="bill_state" id="province" required style="font-size: 16px;padding: 0px;padding-left: 5px;">
                                <option {{($customerdata['bill_state']=='Alberta') ? 'selected' : ''}} value="Alberta">Alberta</option>
                                <option {{($customerdata['bill_state']=='British Columbia') ? 'selected' : ''}} value="British Columbia">British Columbia</option>
                                <option {{($customerdata['bill_state']=='Manitoba') ? 'selected' : ''}} value="Manitoba">Manitoba</option>
                                <option {{($customerdata['bill_state']=='New Brunswick') ? 'selected' : ''}} value="New Brunswick">New Brunswick</option>
                                <option {{($customerdata['bill_state']=='Newfoundland and Labrador') ? 'selected' : ''}} value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                <option {{($customerdata['bill_state']=='Nova Scotia') ? 'selected' : ''}} value="Nova Scotia">Nova Scotia</option>
                                <option {{($customerdata['bill_state']=='Ontario') ? 'selected' : ''}} value="Ontario">Ontario</option>
                                <option {{($customerdata['bill_state']=='Prince Edward Island') ? 'selected' : ''}} value="Prince Edward Island">Prince Edward Island</option>
                                <option {{($customerdata['bill_state']=='Quebec') ? 'selected' : ''}} value="Quebec">Quebec</option>
                                <option {{($customerdata['bill_state']=='Saskatchewan') ? 'selected' : ''}} value="Saskatchewan">Saskatchewan</option>
                                <option {{($customerdata['bill_state']=='Northwest Territories') ? 'selected' : ''}} value="Northwest Territories">Northwest Territories</option>
                                <option {{($customerdata['bill_state']=='Nunavut') ? 'selected' : ''}} value="Nunavut">Nunavut</option>
                                <option {{($customerdata['bill_state']=='Yukon') ? 'selected' : ''}} value="Yukon">Yukon</option>
                            </select>
                        </div>

                        <div class="address-one-con">
                            <span class="input-name">Zipcode/Postal Code</span>
                            <input type="text" required id="zipcode" name="bill_zipcode" value="{{ $customerdata['bill_zipcode'] }}">
                            <span style="color: red;display: none;" id="error_zipcode">Please enter valid zipcode</span>
                            @if ($errors->has('bill_zipcode'))
                                <span class="text-danger">{{ $errors->first('bill_zipcode') }}</span>
                            @endif
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

<div style="display: none;" id="usa_province">
            <option {{($customerdata['bill_state']=='Alabama') ? 'selected' : ''}} value="Alabama">Alabama</option>
            <option {{($customerdata['bill_state']=='Alaska') ? 'selected' : ''}} value="Alaska">Alaska</option>
            <option {{($customerdata['bill_state']=='Arizona') ? 'selected' : ''}} value="Arizona">Arizona</option>
            <option {{($customerdata['bill_state']=='Arkansas') ? 'selected' : ''}} value="Arkansas">Arkansas</option>
            <option {{($customerdata['bill_state']=='California') ? 'selected' : ''}} value="California">California</option>
            <option {{($customerdata['bill_state']=='Colorado') ? 'selected' : ''}} value="Colorado">Colorado</option>
            <option {{($customerdata['bill_state']=='Connecticut') ? 'selected' : ''}} value="Connecticut">Connecticut</option>
            <option {{($customerdata['bill_state']=='Delaware') ? 'selected' : ''}} value="Delaware">Delaware</option>
            <option {{($customerdata['bill_state']=='District Of Columbia') ? 'selected' : ''}} value="District Of Columbia">District Of Columbia</option>
            <option {{($customerdata['bill_state']=='Florida') ? 'selected' : ''}} value="Florida">Florida</option>
            <option {{($customerdata['bill_state']=='Georgia') ? 'selected' : ''}} value="Georgia">Georgia</option>
            <option {{($customerdata['bill_state']=='Hawaii') ? 'selected' : ''}} value="Hawaii">Hawaii</option>
            <option {{($customerdata['bill_state']=='Idaho') ? 'selected' : ''}} value="Idaho">Idaho</option>
            <option {{($customerdata['bill_state']=='Illinois') ? 'selected' : ''}} value="Illinois">Illinois</option>
            <option {{($customerdata['bill_state']=='Indiana') ? 'selected' : ''}} value="Indiana">Indiana</option>
            <option {{($customerdata['bill_state']=='Iowa') ? 'selected' : ''}} value="Iowa">Iowa</option>
            <option {{($customerdata['bill_state']=='Kansas') ? 'selected' : ''}} value="Kansas">Kansas</option>
            <option {{($customerdata['bill_state']=='Kentucky') ? 'selected' : ''}} value="Kentucky">Kentucky</option>
            <option {{($customerdata['bill_state']=='Louisiana') ? 'selected' : ''}} value="Louisiana">Louisiana</option>
            <option {{($customerdata['bill_state']=='Maine') ? 'selected' : ''}} value="Maine">Maine</option>
            <option {{($customerdata['bill_state']=='Maryland') ? 'selected' : ''}} value="Maryland">Maryland</option>
            <option {{($customerdata['bill_state']=='Massachusetts') ? 'selected' : ''}} value="Massachusetts">Massachusetts</option>
            <option {{($customerdata['bill_state']=='Michigan') ? 'selected' : ''}} value="Michigan">Michigan</option>
            <option {{($customerdata['bill_state']=='Minnesota') ? 'selected' : ''}} value="Minnesota">Minnesota</option>
            <option {{($customerdata['bill_state']=='Mississippi') ? 'selected' : ''}} value="Mississippi">Mississippi</option>
            <option {{($customerdata['bill_state']=='Missouri') ? 'selected' : ''}} value="Missouri">Missouri</option>
            <option {{($customerdata['bill_state']=='Montana') ? 'selected' : ''}} value="Montana">Montana</option>
            <option {{($customerdata['bill_state']=='Nebraska') ? 'selected' : ''}} value="Nebraska">Nebraska</option>
            <option {{($customerdata['bill_state']=='Nevada') ? 'selected' : ''}} value="Nevada">Nevada</option>
            <option {{($customerdata['bill_state']=='New Hampshire') ? 'selected' : ''}} value="New Hampshire">New Hampshire</option>
            <option {{($customerdata['bill_state']=='New Jersey') ? 'selected' : ''}} value="New Jersey">New Jersey</option>
            <option {{($customerdata['bill_state']=='New Mexico') ? 'selected' : ''}} value="New Mexico">New Mexico</option>
            <option {{($customerdata['bill_state']=='New York') ? 'selected' : ''}} value="New York">New York</option>
            <option {{($customerdata['bill_state']=='North Carolina') ? 'selected' : ''}} value="North Carolina">North Carolina</option>
            <option {{($customerdata['bill_state']=='North Dakota') ? 'selected' : ''}} value="North Dakota">North Dakota</option>
            <option {{($customerdata['bill_state']=='Ohio') ? 'selected' : ''}} value="Ohio">Ohio</option>
            <option {{($customerdata['bill_state']=='Oklahoma') ? 'selected' : ''}} value="Oklahoma">Oklahoma</option>
            <option {{($customerdata['bill_state']=='Oregon') ? 'selected' : ''}} value="Oregon">Oregon</option>
            <option {{($customerdata['bill_state']=='Pennsylvania') ? 'selected' : ''}} value="Pennsylvania">Pennsylvania</option>
            <option {{($customerdata['bill_state']=='Rhode Island') ? 'selected' : ''}} value="Rhode Island">Rhode Island</option>
            <option {{($customerdata['bill_state']=='South Carolina') ? 'selected' : ''}} value="South Carolina">South Carolina</option>
            <option {{($customerdata['bill_state']=='South Dakota') ? 'selected' : ''}} value="South Dakota">South Dakota</option>
            <option {{($customerdata['bill_state']=='Tennessee') ? 'selected' : ''}} value="Tennessee">Tennessee</option>
            <option {{($customerdata['bill_state']=='Texas') ? 'selected' : ''}} value="Texas">Texas</option>
            <option {{($customerdata['bill_state']=='Utah') ? 'selected' : ''}} value="Utah">Utah</option>
            <option {{($customerdata['bill_state']=='Vermont') ? 'selected' : ''}} value="Vermont">Vermont</option>
            <option {{($customerdata['bill_state']=='Virginia') ? 'selected' : ''}} value="Virginia">Virginia</option>
            <option {{($customerdata['bill_state']=='Washington') ? 'selected' : ''}} value="Washington">Washington</option>
            <option {{($customerdata['bill_state']=='West') ? 'selected' : ''}} value="West Virginia">West Virginia</option>
            <option {{($customerdata['bill_state']=='Wisconsin') ? 'selected' : ''}} value="Wisconsin">Wisconsin</option>
            <option {{($customerdata['bill_state']=='Wyoming') ? 'selected' : ''}} value="Wyoming">Wyoming</option>
    </div>

    <div class="d-none" id="canada_province">
        <option {{($customerdata['bill_state']=='Alberta') ? 'selected' : ''}} value="Alberta">Alberta</option>
        <option {{($customerdata['bill_state']=='British Columbia') ? 'selected' : ''}} value="British Columbia">British Columbia</option>
        <option {{($customerdata['bill_state']=='Manitoba') ? 'selected' : ''}} value="Manitoba">Manitoba</option>
        <option {{($customerdata['bill_state']=='New Brunswick') ? 'selected' : ''}} value="New Brunswick">New Brunswick</option>
        <option {{($customerdata['bill_state']=='Newfoundland and Labrador') ? 'selected' : ''}} value="Newfoundland and Labrador">Newfoundland and Labrador</option>
        <option {{($customerdata['bill_state']=='Nova Scotia') ? 'selected' : ''}} value="Nova Scotia">Nova Scotia</option>
        <option {{($customerdata['bill_state']=='Ontario') ? 'selected' : ''}} value="Ontario">Ontario</option>
        <option {{($customerdata['bill_state']=='Prince Edward Island') ? 'selected' : ''}} value="Prince Edward Island">Prince Edward Island</option>
        <option {{($customerdata['bill_state']=='Quebec') ? 'selected' : ''}} value="Quebec">Quebec</option>
        <option {{($customerdata['bill_state']=='Saskatchewan') ? 'selected' : ''}} value="Saskatchewan">Saskatchewan</option>
        <option {{($customerdata['bill_state']=='Northwest Territories') ? 'selected' : ''}} value="Northwest Territories">Northwest Territories</option>
        <option {{($customerdata['bill_state']=='Nunavut') ? 'selected' : ''}} value="Nunavut">Nunavut</option>
        <option {{($customerdata['bill_state']=='Yukon') ? 'selected' : ''}} value="Yukon">Yukon</option>
    </div>

    @if($customerdata['bill_country']=='USA')
      <script>
          $("#usa_province").show();  
          var province = $("#usa_province").html();  
          $("#province").html(province);
          $("#usa_province").hide();
      </script>  
    @endif
 

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
</script>
</main>
@endsection