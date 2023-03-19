@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Product</h4>
                                    <div class="page-title-right">
                                        <a href="{{ route('addproduct') }}" class="btn btn-primary waves-effect waves-light">Add Product</a>
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
                                        <h4 class="card-title mb-4">Edit Product</h4>
                                        <div class="errors">
                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        @endif
                                        </div>
                                        <form action="{{ route('updateproduct',$product->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$product->id}}"/>
                                            <input type="hidden" name="oldimage" value="{{$product->productimage}}"/>
                                            <input type="hidden" name="oldenglishbrochure" value="{{$product->englishbrochure}}"/>
                                            <input type="hidden" name="oldfrenchbrochure" value="{{$product->frenchbrochure}}"/>
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
                                                    <a class="nav-link" data-bs-toggle="tab" href="#gallery" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Gallery</span>    
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
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#metatags" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Meta Tags</span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#brochure" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                        <span class="d-none d-sm-block">Brochure</span>    
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                            <div class="tab-content p-3 text-muted">
                                                <div class="tab-pane active" id="general" role="tabpanel">
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="productname" class="form-label">Name</label>
                                                                    <input name="productname" type="text" class="form-control" id="productname" value="{{$product->productname}}">
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
                                                                    <input name="slug" type="text" class="form-control" id="slug" value="{{$product->slug}}">
                                                                    @error('slug')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="price" class="form-label">Price</label>
                                                                    <input name="price" type="text" class="form-control" id="price" value="{{$product->price}}">
                                                                    @error('price')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="discountprice" class="form-label">Discount Price</label>
                                                                    <input name="discountprice" type="text" class="form-control" id="discountprice" value="{{$product->discountprice}}">
                                                                    @error('price')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="hideprice" class="form-label">Hide Price</label>
                                                                    <select id="hideprice" class="form-select" name="hideprice">
                                                                        <option value="0" {{ $product->hideprice == 0 ? 'selected' : '' }}>No</option>
                                                                        <option value="1" {{ $product->hideprice == 1 ? 'selected' : '' }}>Yes</option>
                                                                    </select>
                                                                    @error('hideprice')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="productsku" class="form-label">Product Sku</label>
                                                                    <input name="productsku" type="text" class="form-control" id="productsku" value="{{$product->productsku}}">
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
                                                                        <option value="{{$vendor->id}}" {{ $product->vendorid == $vendor->id ? 'selected' : '' }}>{{$vendor->vendorname}}</option>
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
                                                                        <option value="{{$category->id}}" {{ $product->catids == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="status" class="form-label">Status</label>
                                                                    <select id="catstatus" class="form-select" name="status">
                                                                        <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Active</option>
                                                                        <option value="0" {{ $product->status == '0' ? 'selected' : '' }}>Inactive</option>

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
                                                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg" {{ $product->istopproduct == '1' ? 'checked' : '' }} name="istopproduct">
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
                                                                    <input name="order" type="text" class="form-control" id="order" value="{{$product->order}}">
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
                                                                    <textarea type="text" name="shortdescription" id="shortdescription" class="form-control" placeholder="Description">{{$product->shortdescription}}</textarea>
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
                                                            <div class="col-md-3">
                                                                    <div class="mb-3">
                                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$product->productimage);?>
                                                                        @if($exists && $product->productimage!=NULL)
                                                                            <img src="{{ asset('storage/uploads/product/'.$product->productimage) }}" width="100" height="100"/>
                                                                        @else
                                                                                <p>No Image</p>
                                                                        @endif
                                                                    </div>
                                                            </div> 
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="productimagealttext" class="form-label">Image Alt Text</label>
                                                                    <input name="productimagealttext" type="text" class="form-control" id="productimagealttext" value="{{$product->productimagealttext}}">
                                                                    @error('productimagealttext')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div> 
                                                        </div>
                                                </div>
                                                <div class="tab-pane" id="gallery" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                @if(!$productgallery->isEmpty())
                                                                    <table class="productimagestable" border="1">
                                                                    <th></th>
                                                                    <th>Remove Image</th>
                                                                    @foreach($productgallery as $productgalleryimage)
                                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$productgalleryimage->imagename);?>
                                                                        @if($exists && $productgalleryimage->imagename!=NULL || 1==1)
                                                                        <tr><td>
                                                                        <img src="{{ asset('storage/uploads/product/'.$productgalleryimage->imagename) }}" width="100" height="100"/>
                                                                        </td>
                                                                        <td>
                                                                            <div class="checkbox checkbox-primary d-inline">
                                                                            <input type="checkbox" name="removeimages[]" id="removeimages-{{ $productgalleryimage->id}}" value="{{$productgalleryimage->id}}">
                                                                            <label for="removeimages-{{ $productgalleryimage->id}}" class="cr"></label>
                                                                            </div>
                                                                        </td>
                                                                        </tr>
                                                                        @endif
                                                                    @endforeach
                                                                   </table>
                                                                @else
                                                                    <p class="bg-danger text-white p-1">No Images</p>
                                                                @endif
                                                            </div>
                                                        </div>   
                                                        <div class="col-md-6">
                                                            <div class="mt-3">
                                                                <label for="productgallery" class="form-label">Add Images</label>
                                                                <input class="form-control" type="file" name="productgallery[]" id="productgallery" multiple>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="longdescription" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="mb-3">
                                                                <label>Description</label>
                                                                <textarea type="text" name="longdescription" id="specification" class="form-control" placeholder="Description">{{$product->longdescription}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="metatags" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="metatitle" class="form-label">Title</label>
                                                                <input name="metatitle" type="text" class="form-control" id="metatitle" value="{{$product->metatitle}}">
                                                                @error('metatitle')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="metakeywords" class="form-label">Tags</label>
                                                                <input name="metakeywords" type="text" class="form-control" id="metakeywords" value="{{$product->metakeywords}}">
                                                                @error('metakeywords')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="sourcelink" class="form-label">Source Link</label>
                                                                <input name="sourcelink" type="text" class="form-control" id="sourcelink" value="{{$product->sourcelink}}">
                                                                @error('sourcelink')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="metadescription" class="form-label">Description</label>
                                                                <textarea name="metadescription" id="metadescription" class="form-control" placeholder="Description">{{$product->metadescription}}</textarea>
                                                                @error('metadescription')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="productoptions" role="tabpanel">
                                                   
                                                    @foreach($productoptions as $productoption)
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="option_name" class="form-label">Option Name</label>
                                                                    <input name="option_name[{{$productoption->id}}]" type="text" class="form-control" id="option_name" value="{{$productoption->optionname}}" required="">
                                                                    @error('optionname')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="option_price" class="form-label">Option Price</label>
                                                                    <input name="option_price[{{$productoption->id}}]" type="text" class="form-control" id="option_price" value="{{$productoption->price}}">
                                                                    @error('option_price')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="option_discountprice" class="form-label">Option Discount Price</label>
                                                                    <input name="option_discountprice[{{$productoption->id}}]" type="text" class="form-control" id="option_discountprice" value="{{$productoption->discountprice}}">
                                                                    @error('option_discountprice')
                                                                        <span class="input-invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                          
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
                                                                        @foreach(explode(',', $product->rplist) as $info)
                                                                            @if($info == $relatedproduct->id)
                                                                                @php
                                                                                $isselected = 'selected';
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
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
                                                                        @foreach(explode(',', $product->applications) as $info)
                                                                            @if($info == $application->id)
                                                                                @php
                                                                                $isselected = 'selected';
                                                                                @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        <option value="{{ $application->id }}" {{ $isselected }}>{{ $application->applicationname }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="brochure" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="englishbrochure" class="form-label">English</label>
                                                                        <input class="form-control" type="file" id="englishbrochure" name="englishbrochure">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/brochure/en/'.$product->englishbrochure);?>
                                                                        @if($exists && $product->englishbrochure!=NULL)
                                                                        <a href="{{ asset('storage/uploads/product/brochure/en/'.$product->englishbrochure) }}" id="englishbrochurelink"/>Click Here for english brochure</a>
                                                                        <div><button type="button" class="btn btn-outline-danger waves-effect waves-light" onclick="removebrochure('englishbrochure')">Remove brochure</button></div>
                                                                        @else
                                                                                <p>No Brochure</p>
                                                                        @endif
                                                                    </div>
                                                            </div>   
                                                            <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="frenchbrochure" class="form-label">French</label>
                                                                        <input class="form-control" type="file" id="frenchbrochure" name="frenchbrochure">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/brochure/fr/'.$product->frenchbrochure);?>
                                                                        @if($exists && $product->frenchbrochure!=NULL)
                                                                        <a href="{{ asset('storage/uploads/product/brochure/fr/'.$product->frenchbrochure) }}"  id="frenchbrochurelink"/>Click Here for french brochure</a>
                                                                        <div><button type="button" class="btn btn-outline-danger waves-effect waves-light" onclick="removebrochure('frenchbrochure')">Remove brochure</button></div>
                                                                        @else
                                                                                <p>No Brochure</p>
                                                                        @endif
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