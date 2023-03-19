@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Product</h4>
                                    <div class="page-title-right">
                                        <a href="{{ route('allproduct') }}" class="btn btn-primary waves-effect waves-light">View All Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Add Product</h4>
                                        <div class="errors">
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        @endif
                                        </div>
                                        <form action="{{ route('storeproduct') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">General</span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#productoptions" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Options / Variations</span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#longdescription" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Long Description</span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#relatedproducts" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Related Products</span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#applications" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Industry/Applications</span>    
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                            <div class="tab-content p-3 text-muted">
                                                <div class="tab-pane active" id="general" role="tabpanel">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="productname" class="form-label">Name</label>
                                                                    <input name="productname" type="text" class="form-control" id="productname" value="{{old('productname')}}">
                                                                    @error('productname')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="slug" class="form-label">Slug</label>
                                                                    <input name="slug" type="text" class="form-control" id="slug" value="{{old('slug')}}">
                                                                    @error('slug')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="price" class="form-label">Price</label>
                                                                    <input name="price" type="text" class="form-control" id="price" value="{{old('price')}}">
                                                                    @error('price')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="discountprice" class="form-label">Discount Price</label>
                                                                    <input name="discountprice" type="text" class="form-control" id="discountprice" value="{{old('discountprice')}}">
                                                                    @error('price')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="productsku" class="form-label">Product Sku</label>
                                                                    <input name="productsku" type="text" class="form-control" id="productsku" value="{{old('productsku')}}">
                                                                    @error('productsku')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="vendorid" class="form-label">Vendor</label>
                                                                    <select id="vendorid" class="form-select" name="vendorid">
                                                                        <option value="">None</option>
                                                                        @foreach($vendors as $vendor)
                                                                        <option value="{{$vendor->id}}" {{ old('vendorid') == $vendor->id ? 'selected' : '' }}>{{$vendor->vendorname}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('productsku')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="status">Category</label>
                                                                    <select id="catids" class="form-select" name="catids">
                                                                        <option value="">None</option>
                                                                        @foreach($categories as $category)
                                                                        <option value="{{$category->id}}" {{ old('catids') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select id="catstatus" class="form-select" name="status">
                                                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>

                                                                    </select>
                                                                    @error('status')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Include In Top Products</label>
                                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" {{ old('istopproduct') == 'on' ? 'checked' : '' }} name="istopproduct">
                                                                        <label class="form-check-label" for="SwitchCheckSizelg">Do you want to display in top list</label>
                                                                    </div>
                                                                    @error('istopproduct')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="order" class="form-label">Top Product Order</label>
                                                                    <input name="order" type="text" class="form-control" id="order" value="{{old('order')}}">
                                                                    @error('order')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="mb-3">
                                                                    <label>Short Description</label>
                                                                    <textarea type="text" name="shortdescription" id="shortdescription" class="form-control" placeholder="Description">{{old('shortdescription')}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="productimage" class="form-label">Image</label>
                                                                        <input class="form-control" type="file" id="productimage" name="productimage">
                                                                    </div>
                                                            </div>   
                                                        </div>
                                                </div>
                                                <div class="tab-pane" id="longdescription" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="mb-3">
                                                                <label>Description</label>
                                                                <textarea type="text" name="longdescription" id="specification" class="form-control" placeholder="Description">{{ old('longdescription') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="productoptions" role="tabpanel">
                                                    <div id="appendnewoptions"></div>
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="mb-3">
                                                                <div class="form-group">
                                                                    <button type="button" class="btn  btn-primary" id="addoptionrow">Add Options</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="relatedproducts" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="mb-3">
                                                                <label>Related Products</label>
                                                                <select class="select2 form-control select2-multiple" multiple="multiple" id="rplist" name="rplist[]" data-placeholder="Choose ...">
                                                                   
                                                                    @foreach($allproducts as $relatedproduct)
                                                                    @php
                                                                        $isselected = '';
                                                                    @endphp
                                                                       
                                                                        <option value="{{ $relatedproduct->id }}" {{ $isselected }}>{{ $relatedproduct->productname }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="applications" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="mb-3">
                                                                <label>Industry/Applications</label>
                                                                <select class="select2 form-control select2-multiple" multiple="multiple" id="applications" name="applications[]" data-placeholder="Choose ...">
                                                                   
                                                                    @foreach($applications as $application)
                                                                    @php
                                                                        $isselected = '';
                                                                    @endphp
                                                                        
                                                                        <option value="{{ $application->id }}" {{ $isselected }}>{{ $application->applicationname }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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