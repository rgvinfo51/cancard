@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Category</h4>
                                    <div class="page-title-right">
                                        <a href="{{ route('addcategory') }}" class="btn btn-primary waves-effect waves-light">Add Category</a>
                                        <a href="{{ route('allcategory') }}" class="btn btn-primary waves-effect waves-light">View All Category</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Edit Category</h4>
                                       
                                        <form action="{{ route('updatecategory',$category->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$category->id}}"/>
                                            <input type="hidden" name="oldimage" value="{{$category->categoryimage}}"/>
                                            <input type="hidden" name="oldbanner" value="{{$category->banner}}"/>
                                            <div class="row">
                                                
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="categoryname" class="form-label">Name</label>
                                                        <input name="name" type="text" class="form-control" id="categoryname" value="{{ $category->name}}">
                                                        @error('name')
                                                            <span class="input-invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="slug" class="form-label">Slug</label>
                                                        <input name="slug" type="text" class="form-control" id="slug" value="{{ $category->slug}}">
                                                        @error('slug')
                                                            <span class="input-invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="mb-3">
                                                        <label for="sortorder" class="form-label">Order</label>
                                                        <input name="sortorder" type="text" class="form-control" id="sortorder" value="{{ $category->sortorder}}">
                                                        @error('sortorder')
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
                                                        <label for="status">Parent Category</label>
                                                        <select id="parentid" class="form-select" name="parentid">
                                                            <option value="">None</option>
                                                            @foreach($allcategories as $parentcategory)
                                                            <option value="{{$parentcategory->id}}" {{ $parentcategory->id == $category->parentid ? 'selected' : '' }}>{{$parentcategory->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('parentid')
                                                            <span class="input-invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select id="catstatus" class="form-select" name="status">
                                                            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>Inactive</option>

                                                        </select>
                                                        @error('status')
                                                            <span class="input-invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                            <div class="mb-3">
                                                                <label>Industry/Applications</label>
                                                                <select class="select2 form-control select2-multiple" multiple="multiple" id="applications" name="applications[]" data-placeholder="Choose ...">
                                                                   
                                                                    @foreach($applications as $application)
                                                                    @php
                                                                        $isselected = '';
                                                                    @endphp
                                                                        @foreach(explode(',', $category->applications) as $info)
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
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="mb-3">
                                                        <label>Short Description</label>
                                                        <input name="shortdescription" type="text" class="form-control" value="{{ $category->shortdescription}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea type="text" name="description" id="shortdescription" class="form-control" placeholder="Description">{{ $category->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="categoryimage" class="form-label">Image</label>
                                                            <input class="form-control" type="file" id="categoryimage" name="categoryimage">
                                                        </div>
                                                        <div class="mb-3">
                                                            <?php  $exists = Storage::disk('public')->exists('/uploads/category/'.$category->categoryimage);?>
                                                            @if($exists && $category->categoryimage!=NULL)
                                                                <img src="{{ asset('storage/uploads/category/'.$category->categoryimage) }}" width="" height="150"/>
                                                            @else
                                                                
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="categoryimagealttext" class="form-label">Image Alt Text</label>
                                                            <input name="categoryimagealttext" type="text" class="form-control" id="categoryimagealttext" value="{{$category->categoryimagealttext}}">
                                                            @error('categoryimagealttext')
                                                                <span class="input-invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                </div>   
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="banner" class="form-label">Banner Image</label>
                                                            <input class="form-control" type="file" id="banner" name="banner">
                                                        </div>
                                                        <div class="mb-3">
                                                            <?php  $exists = Storage::disk('public')->exists('/uploads/categorybanner/'.$category->banner);?>
                                                            @if($exists && $category->banner!=NULL)
                                                                <img src="{{ asset('storage/uploads/categorybanner/'.$category->banner) }}" width="" height="150"/>
                                                            @else
                                                                
                                                            @endif
                                                        </div> 
                                                        <div class="mb-3">
                                                            <label for="banneralttext" class="form-label">Banner Alt Text</label>
                                                            <input name="banneralttext" type="text" class="form-control" id="banneralttext" value="{{$category->banneralttext}}">
                                                            @error('banneralttext')
                                                                <span class="input-invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                </div>   
                                            </div>
                                            <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="metatitle" class="form-label">Meta Title</label>
                                                                <input name="metatitle" type="text" class="form-control" id="metatitle" value="{{$category->metatitle}}">
                                                                @error('metatitle')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="metakeywords" class="form-label">Meta Keywords</label>
                                                                <input name="metakeywords" type="text" class="form-control" id="metakeywords" value="{{$category->metakeywords}}">
                                                                @error('metakeywords')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="metadescription" class="form-label">Meta Description</label>
                                                                <textarea name="metadescription" id="metadescription" class="form-control" placeholder="Description">{{$category->metadescription}}</textarea>
                                                                @error('metadescription')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
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