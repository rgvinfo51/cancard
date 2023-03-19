@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Vendors</h4>
                                     <div class="page-title-right">
                                            <a href="{{ route('allvendors') }}" class="btn btn-primary waves-effect waves-light">View All Vendors</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Edit Vendor</h4>
                                       
                                        <form action="{{ route('updatevendor',$vendor->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$vendor->id}}"/>
                                            <div class="mb-3">
                                                <label for="vendorname" class="form-label">Name</label>
                                                <input name="vendorname" type="text" class="form-control" id="vendorname" value="{{ $vendor->vendorname}} ">
                                                @error('vendorname')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="vendorinfo" class="form-label">Details</label>
                                                <input name="vendorinfo" type="text" class="form-control" id="vendorinfo" value="{{ $vendor->vendorinfo}} ">
                                                @error('vendorinfo')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
</div>
@endsection