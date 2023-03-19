<!-- Modal Header -->
<div class="modal-header">
    <h4 class="modal-title">Add Shipping Address</h4>
    <button type="button" class="close" data-dismiss="modal" style="font-size: 20px;padding: 15px 20px;">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body">

        <form action="{{route('add.more.address')}}" method="POST" onsubmit="return ValidateForm()">
    <div class="card-body bg-white">
            @csrf
            <input type="hidden" name="user_id" value="{{$customerdata->id}}">

            <div class="form-row row">
                <div class="col-12 form-group required mb-3">
                    <label class="control-label" for="address1">Address Line 1*</label> <input autocomplete="off" class="form-control card-num" placeholder="Enter Address Line 1" name="address1" id="address1" size="20" type="text" required>
                </div>
            </div>

            <div class="form-row row">
                <div class="col-12 form-group mb-3">
                    <label class="control-label font-12" for="address2">Address Line 2(Optional)</label> <input autocomplete="off" class="form-control card-cvc" placeholder="Enter Address Line 2" size="4" type="text" name="address2" id="address2">
                </div>
            </div>

            <div class="row">
                <div class="col-4 form-group mb-3">
                    <label class="control-label font-12" for="city">City*</label> <input autocomplete="off" class="form-control card-cvc" placeholder="Enter City" size="4" type="text" name="city" id="city" required>
                </div>
                <div class="col-4 form-group mb-3">
                    <label class="control-label font-12" for="country">Country*</label> 
                    <select name="country" id="country" onchange="fetchProvince(this.value)" required style="font-size: 16px;padding: 0px;padding-left: 5px;">
                        <option value="Canada">Canada</option>
                        <option value="USA">USA</option>
                    </select>
                </div>
                <div class="col-4 form-group mb-3">
                    <label class="control-label font-12" for="province">Province/State*</label>
                    <select name="province" id="province" required style="font-size: 16px;padding: 0px;padding-left: 5px;">
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
                <div class="col-md-12 mb-3 m-0 p-0">
                    <div class="col-md-4 mb-2">
                        <label class="control-label font-12" for="zipcode">Postal Code/Zipcode*</label> <input autocomplete="off" class="form-control card-cvc" placeholder="Enter Zipcode/Postal Code" size="4" type="text" name="zipcode" id="zipcode" required>
                    </div>
                    <span style="color: red;padding-left: 16px;display: none;" id="error_zipcode">Please enter valid Zipcode/Postal Code</span>
                </div>
            </div>

            <hr>

            <div class="row text-right float-right">
                <button class="btn btn-primary mr-4">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

        </form>
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
    
</script>
