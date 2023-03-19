@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

<div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Edit Customer</h4>
                                    <div class="page-title-right">
                                            <a href="{{ route('customerpricing',$customerdetails->id) }}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus me-1"></i> Custom Pricing</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <form action="{{ route('updatecustomer',$customerdetails->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="error message">
                                            @if ($message = Session::get('success'))

                                                <div class="alert alert-success alert-block">

                                                    <button type="button" class="close" data-dismiss="alert">x</button>

                                                    <strong>{{ $message }}</strong>

                                                </div>

                                            @endif

                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <h4 class="card-title">Basic Information</h4>
                                        <p class="card-title-desc">Fill all information below</p>
        
                                         <input type="hidden" name="cid" value="{{ $customerdetails->id }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="email">Email</label>
                                                        <input id="email" name="email" type="email" class="form-control" value="{{ $customerdetails->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name">Name</label>
                                                        <input id="name" name="name" type="text" class="form-control" value="{{ $customerdetails->name }}">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="phoneno">Phone No</label>
                                                        <input id="phoneno" name="phoneno" type="text" class="form-control" value="{{ $customerdetails->phoneno }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="company">Company Name</label>
                                                        <input id="company" name="company" type="text" class="form-control" value="{{ $customerdetails->company }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="company">Customer ID</label>
                                                        <input id="customer_id" name="customer_id" type="text" class="form-control" value="{{ $customerdetails->customer_id }}" readonly>
                                                    </div>
                                                    
                                                </div>
        
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="customerno">Customer No</label>
                                                        <input id="customerno" name="customerno" type="text" class="form-control" value="{{ $customerdetails->customerno }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="control-label">Customer Type</label>
                                                        <select id="customertype" class="form-select" name="customertype">
                                                            <option value="">None</option>
                                                            @foreach($customertypes as $customertype)
                                                            <option value="{{$customertype->id}}" {{ $customerdetails->customertype == $customertype->id ? 'selected' : '' }}>{{$customertype->ctname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="discount">Discount</label>
                                                        <input id="discount" name="discount" type="text" class="form-control" value="{{ $customerdetails->discount }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="control-label">Status</label>
                                                        <select class="form-control select2" name="status">
                                                            <option value="0" {{ $customerdetails->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                            <option value="1" {{ $customerdetails->status == 1 ? 'selected' : '' }}>Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                                <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                            </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Address Information</h4>
                                        <p class="card-title-desc">Fill all information below</p>
        
                                        
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="bill_address1">Billing Address 1</label>
                                                        <input id="bill_address1" name="bill_address1" type="text" class="form-control" value="{{ $customerdetails->bill_address1 }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bill_address2">Billing Address 2</label>
                                                        <input id="bill_address2" name="bill_address2" type="text" class="form-control" value="{{ $customerdetails->bill_address2 }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bill_city">City </label>
                                                        <input id="bill_city" name="bill_city" type="text" class="form-control" value="{{ $customerdetails->bill_city }}">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="bill_state">State</label>
                                                        <input id="bill_state" name="bill_state" type="text" class="form-control" value="{{ $customerdetails->bill_state }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="bill_zipcode">Zipcode</label>
                                                        <input id="bill_zipcode" name="bill_zipcode" type="text" class="form-control" value="{{ $customerdetails->bill_zipcode }}">
                                                    </div>
                                                </div>
        
                                                <div class="col-sm-6">
                                                    
                                                    <div class="mb-3">
                                                        <label for="ship_address1">Shipping Address 1</label>
                                                        <input id="ship_address1" name="ship_address1" type="text" class="form-control" value="{{ $customerdetails->ship_address1 }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ship_address2">Shipping Address 2</label>
                                                        <input id="ship_address2" name="ship_address2" type="text" class="form-control" value="{{ $customerdetails->ship_address2 }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ship_city">City </label>
                                                        <input id="ship_city" name="ship_city" type="text" class="form-control" value="{{ $customerdetails->ship_city }}">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="ship_state">State</label>
                                                        <input id="ship_state" name="ship_state" type="text" class="form-control" value="{{ $customerdetails->ship_state }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ship_zipcode">Zipcode</label>
                                                        <input id="ship_zipcode" name="ship_zipcode" type="text" class="form-control" value="{{ $customerdetails->ship_zipcode }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                            </div>
        
                                    </div>
                                </div>
                                
        
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Reset Password</h4>
                                        <p class="card-title-desc">Fill all information below</p>
        
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="metatitle">New Password</label>
                                                        <input id="metatitle" name="new_password" type="password" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="metatitle">Confirm New Password</label>
                                                        <input id="metatitle" name="new_password_confirmation" type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                                <button type="submit" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                            </div>
                                        
        
                                    </div>
                                </div>
                            </div>
                        </div>
                            </form>
                            </div>
                        <!-- end row -->
                         @endsection