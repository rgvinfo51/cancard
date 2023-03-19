@extends('frontend.mainmaster')
@section('content')

<main class="main-container profilearea">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">    
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con address-profile-con">
                <h2>My Profile</h2>
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
                <form method="post" id="reset_on_cancel" action="{{route('profile.update')}}" onsubmit="return ValidateForm()">
                @csrf
                    {{-- <div class="first-last-name-con">
                        <div class="address-one-con p-0 m-0">
                            <span class="input-name">First Name</span>
                            <input type="text" required>
                        </div>
                        <div class="address-one-con p-0 m-0">
                            <span class="input-name">Last Name</span>
                            <input type="text" required>
                        </div>
                    </div>--}}
                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Name</span>
                        <input type="text" name="name" id="name" value="{{ $customerdata['name'] }}" required disabled>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Title/Role</span>
                        <input type="text" name="posttitle" id="posttitle" disabled value="{{ $customerdata['posttitle'] }}">
                        @if ($errors->has('posttitle'))
                            <span class="text-danger">{{ $errors->first('posttitle') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Company Name</span>
                        <input type="text" name="company" id="company" disabled value="{{ $customerdata['company'] }}" required>
                        @if ($errors->has('company'))
                            <span class="text-danger">{{ $errors->first('company') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Email address</span>
                        <input type="email"  name="email" id="email" disabled required value="{{ $customerdata['email'] }}" readonly="">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Alternate Email </span>
                        <input type="email"  name="alt_email" disabled id="alt_email" value="{{ $customerdata['alt_email'] }}">
                        @if ($errors->has('alt_email'))
                            <span class="text-danger">{{ $errors->first('alt_email') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Office Phone</span>
                        <input type="number" name="officeno" id="officeno" disabled value="{{ $customerdata['office_no'] }}">
                        @if ($errors->has('officeno'))
                            <span class="text-danger">{{ $errors->first('officeno') }}</span>
                        @endif
                    </div>
                    
                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Phone No</span>
                        <input type="text" name="phoneno" id="phoneno" disabled value="{{ $customerdata['phoneno'] }}" required>
                        @if ($errors->has('phoneno'))
                            <span class="text-danger">{{ $errors->first('phoneno') }}</span>
                        @endif
                    </div>
                    
                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Customer ID</span>
                        <input type="text" name="customer_id" value="{{ $customerdata['customer_id'] }}" readonly>
                        @if ($errors->has('customer_id'))
                            <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Address 1</span>
                        <input type="text" name="corporateaddress" disabled id="corporateaddress" value="{{ $customerdata['corporateaddress'] }}">
                        @if ($errors->has('corporateaddress'))
                            <span class="text-danger">{{ $errors->first('corporateaddress') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">Address 2</span>
                        <input type="text" name="address2" disabled id="address2" value="{{ $customerdata['address2'] }}">
                        @if ($errors->has('address2'))
                            <span class="text-danger">{{ $errors->first('address2') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name">City</span>
                        <input type="text" name="city" disabled id="city" value="{{ $customerdata['city'] }}">
                        @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0 mb-4">
                        <span class="input-name">Country</span>
                        <select name="country" id="country" disabled onchange="fetchProvince(this.value)" required style="font-size: 16px;padding: 0px;padding-left: 15px;">
                            <option @if($customerdata['country']=='Canada') {{'selected'}} @endif value="Canada">Canada</option>
                            <option @if($customerdata['country']=='USA') {{'selected'}} @endif value="USA">USA</option>
                        </select>
                        @if ($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0 mb-4">
                        <span class="input-name">Province</span>
                        <select name="province" id="province" disabled required style="font-size: 16px;padding: 0px;padding-left: 15px;">
                            <option {{($customerdata['province']=='Alberta') ? 'selected' : ''}} value="Alberta">Alberta</option>
                            <option {{($customerdata['province']=='British Columbia') ? 'selected' : ''}} value="British Columbia">British Columbia</option>
                            <option {{($customerdata['province']=='Manitoba') ? 'selected' : ''}} value="Manitoba">Manitoba</option>
                            <option {{($customerdata['province']=='New Brunswick') ? 'selected' : ''}} value="New Brunswick">New Brunswick</option>
                            <option {{($customerdata['province']=='Newfoundland and Labrador') ? 'selected' : ''}} value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                            <option {{($customerdata['province']=='Nova Scotia') ? 'selected' : ''}} value="Nova Scotia">Nova Scotia</option>
                            <option {{($customerdata['province']=='Ontario') ? 'selected' : ''}} value="Ontario">Ontario</option>
                            <option {{($customerdata['province']=='Prince Edward Island') ? 'selected' : ''}} value="Prince Edward Island">Prince Edward Island</option>
                            <option {{($customerdata['province']=='Quebec') ? 'selected' : ''}} value="Quebec">Quebec</option>
                            <option {{($customerdata['province']=='Saskatchewan') ? 'selected' : ''}} value="Saskatchewan">Saskatchewan</option>
                            <option {{($customerdata['province']=='Northwest Territories') ? 'selected' : ''}} value="Northwest Territories">Northwest Territories</option>
                            <option {{($customerdata['province']=='Nunavut') ? 'selected' : ''}} value="Nunavut">Nunavut</option>
                            <option {{($customerdata['province']=='Yukon') ? 'selected' : ''}} value="Yukon">Yukon</option>
                        </select>
                        @if ($errors->has('province'))
                            <span class="text-danger">{{ $errors->first('province') }}</span>
                        @endif
                    </div>

                    <div class="address-one-con p-0 m-0">
                        <span class="input-name pb-1">Zipcode/Postal Code</span>
                        <input autocomplete="off" class="card-cvc" disabled size="4" type="text" name="zipcode" id="zipcode" value="{{ $customerdata['zipcode'] }}" style="font-size: 16px;padding: 0px;padding-left: 15px;">
                        <span style="color: red;display: none;" id="error_zipcode">Please enter valid Zipcode/Postal Code</span>
                        @if ($errors->has('corporateaddress'))
                            <span class="text-danger">{{ $errors->first('corporateaddress') }}</span>
                        @endif
                    </div>

                    
                    
                    <div class="submit-savechanges p-0">
                        <!-- <input class="submit-savechanges" type="submit" value="Save"> -->
                        <a class="btn-primary btn edit_profile" onclick="editUserProfile('edit')">Edit Profile</a>
                        <button class="btn-primary btn update_profile" style="display: none;">Update Profile</button>
                        <a class="cancel_profile pl-5" style="display: none;cursor: pointer" onclick="editUserProfile('cancel')">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div style="display: none;" id="usa_province">
            <option {{($customerdata['province']=='Alabama') ? 'selected' : ''}} value="Alabama">Alabama</option>
            <option {{($customerdata['province']=='Alaska') ? 'selected' : ''}} value="Alaska">Alaska</option>
            <option {{($customerdata['province']=='Arizona') ? 'selected' : ''}} value="Arizona">Arizona</option>
            <option {{($customerdata['province']=='Arkansas') ? 'selected' : ''}} value="Arkansas">Arkansas</option>
            <option {{($customerdata['province']=='California') ? 'selected' : ''}} value="California">California</option>
            <option {{($customerdata['province']=='Colorado') ? 'selected' : ''}} value="Colorado">Colorado</option>
            <option {{($customerdata['province']=='Connecticut') ? 'selected' : ''}} value="Connecticut">Connecticut</option>
            <option {{($customerdata['province']=='Delaware') ? 'selected' : ''}} value="Delaware">Delaware</option>
            <option {{($customerdata['province']=='District Of Columbia') ? 'selected' : ''}} value="District Of Columbia">District Of Columbia</option>
            <option {{($customerdata['province']=='Florida') ? 'selected' : ''}} value="Florida">Florida</option>
            <option {{($customerdata['province']=='Georgia') ? 'selected' : ''}} value="Georgia">Georgia</option>
            <option {{($customerdata['province']=='Hawaii') ? 'selected' : ''}} value="Hawaii">Hawaii</option>
            <option {{($customerdata['province']=='Idaho') ? 'selected' : ''}} value="Idaho">Idaho</option>
            <option {{($customerdata['province']=='Illinois') ? 'selected' : ''}} value="Illinois">Illinois</option>
            <option {{($customerdata['province']=='Indiana') ? 'selected' : ''}} value="Indiana">Indiana</option>
            <option {{($customerdata['province']=='Iowa') ? 'selected' : ''}} value="Iowa">Iowa</option>
            <option {{($customerdata['province']=='Kansas') ? 'selected' : ''}} value="Kansas">Kansas</option>
            <option {{($customerdata['province']=='Kentucky') ? 'selected' : ''}} value="Kentucky">Kentucky</option>
            <option {{($customerdata['province']=='Louisiana') ? 'selected' : ''}} value="Louisiana">Louisiana</option>
            <option {{($customerdata['province']=='Maine') ? 'selected' : ''}} value="Maine">Maine</option>
            <option {{($customerdata['province']=='Maryland') ? 'selected' : ''}} value="Maryland">Maryland</option>
            <option {{($customerdata['province']=='Massachusetts') ? 'selected' : ''}} value="Massachusetts">Massachusetts</option>
            <option {{($customerdata['province']=='Michigan') ? 'selected' : ''}} value="Michigan">Michigan</option>
            <option {{($customerdata['province']=='Minnesota') ? 'selected' : ''}} value="Minnesota">Minnesota</option>
            <option {{($customerdata['province']=='Mississippi') ? 'selected' : ''}} value="Mississippi">Mississippi</option>
            <option {{($customerdata['province']=='Missouri') ? 'selected' : ''}} value="Missouri">Missouri</option>
            <option {{($customerdata['province']=='Montana') ? 'selected' : ''}} value="Montana">Montana</option>
            <option {{($customerdata['province']=='Nebraska') ? 'selected' : ''}} value="Nebraska">Nebraska</option>
            <option {{($customerdata['province']=='Nevada') ? 'selected' : ''}} value="Nevada">Nevada</option>
            <option {{($customerdata['province']=='New Hampshire') ? 'selected' : ''}} value="New Hampshire">New Hampshire</option>
            <option {{($customerdata['province']=='New Jersey') ? 'selected' : ''}} value="New Jersey">New Jersey</option>
            <option {{($customerdata['province']=='New Mexico') ? 'selected' : ''}} value="New Mexico">New Mexico</option>
            <option {{($customerdata['province']=='New York') ? 'selected' : ''}} value="New York">New York</option>
            <option {{($customerdata['province']=='North Carolina') ? 'selected' : ''}} value="North Carolina">North Carolina</option>
            <option {{($customerdata['province']=='North Dakota') ? 'selected' : ''}} value="North Dakota">North Dakota</option>
            <option {{($customerdata['province']=='Ohio') ? 'selected' : ''}} value="Ohio">Ohio</option>
            <option {{($customerdata['province']=='Oklahoma') ? 'selected' : ''}} value="Oklahoma">Oklahoma</option>
            <option {{($customerdata['province']=='Oregon') ? 'selected' : ''}} value="Oregon">Oregon</option>
            <option {{($customerdata['province']=='Pennsylvania') ? 'selected' : ''}} value="Pennsylvania">Pennsylvania</option>
            <option {{($customerdata['province']=='Rhode Island') ? 'selected' : ''}} value="Rhode Island">Rhode Island</option>
            <option {{($customerdata['province']=='South Carolina') ? 'selected' : ''}} value="South Carolina">South Carolina</option>
            <option {{($customerdata['province']=='South Dakota') ? 'selected' : ''}} value="South Dakota">South Dakota</option>
            <option {{($customerdata['province']=='Tennessee') ? 'selected' : ''}} value="Tennessee">Tennessee</option>
            <option {{($customerdata['province']=='Texas') ? 'selected' : ''}} value="Texas">Texas</option>
            <option {{($customerdata['province']=='Utah') ? 'selected' : ''}} value="Utah">Utah</option>
            <option {{($customerdata['province']=='Vermont') ? 'selected' : ''}} value="Vermont">Vermont</option>
            <option {{($customerdata['province']=='Virginia') ? 'selected' : ''}} value="Virginia">Virginia</option>
            <option {{($customerdata['province']=='Washington') ? 'selected' : ''}} value="Washington">Washington</option>
            <option {{($customerdata['province']=='West') ? 'selected' : ''}} value="West Virginia">West Virginia</option>
            <option {{($customerdata['province']=='Wisconsin') ? 'selected' : ''}} value="Wisconsin">Wisconsin</option>
            <option {{($customerdata['province']=='Wyoming') ? 'selected' : ''}} value="Wyoming">Wyoming</option>
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

    @if($customerdata['country']=='USA')
      <script>
          $("#usa_province").show();  
          var province = $("#usa_province").html();  
          $("#province").html(province);
          $("#usa_province").hide();
      </script>  
    @endif
</main>

<script>
    function fetchProvince(value){
         if(value=='USA'){
             $("#province").html($("#usa_province").html());
         }
         if(value=='Canada'){
             $("#province").html($("#canada_province").html());
         }
    }

    // Edit Profile
    function editUserProfile(action) {

        if(action == 'edit'){
            $("#corporateaddress").removeAttr("disabled");
            $("#name").removeAttr("disabled");
            $("#posttitle").removeAttr("disabled");
            $("#company").removeAttr("disabled");
            $("#email").removeAttr("disabled");
            $("#alt_email").removeAttr("disabled");
            $("#officeno").removeAttr("disabled");
            $("#phoneno").removeAttr("disabled");
            $("#address2").removeAttr("disabled");
            $("#city").removeAttr("disabled");
            $("#country").removeAttr("disabled");
            $("#province").removeAttr("disabled");
            $("#zipcode").removeAttr("disabled");
            $(".edit_profile").hide();
            $(".update_profile").show();
            $(".cancel_profile").show();
        }

        if(action == 'cancel'){
            $("#corporateaddress").attr('disabled', 'disabled');
            $("#name").attr('disabled', 'disabled');
            $("#posttitle").attr('disabled', 'disabled');
            $("#company").attr('disabled', 'disabled');
            $("#email").attr('disabled', 'disabled');
            $("#alt_email").attr('disabled', 'disabled');
            $("#officeno").attr('disabled', 'disabled');
            $("#phoneno").attr('disabled', 'disabled');
            $("#address2").attr('disabled', 'disabled');
            $("#city").attr('disabled', 'disabled');
            $("#country").attr('disabled', 'disabled');
            $("#province").attr('disabled', 'disabled');
            $("#zipcode").attr('disabled', 'disabled');
            $(".edit_profile").show();
            $(".update_profile").hide();
            $(".cancel_profile").hide();
            $("#reset_on_cancel")[0].reset();
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

@endsection