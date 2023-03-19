@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Category</h4>
                                    <div class="page-title-right">
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
                                        <h4 class="card-title mb-4">Add Category</h4>
                                        
                                        <form action="{{ route('insertcategory') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="row">
                                                
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="categoryname" class="form-label">Name</label>
                                                        <input name="name" type="text" class="form-control" id="categoryname">
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
                                                        <input name="slug" type="text" class="form-control" id="slug">
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
                                                        <input name="sortorder" type="text" class="form-control" id="sortorder">
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
                                                            @foreach($categories as $key =>$category)
                                                            <option value="{{$category->id}}" {{ old('category') == $key ? 'selected' : '' }}>{{$category->name}}</option>
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
                                                <div class="col-md-4">
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
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="mb-3">
                                                        <label>Short Description</label>
                                                        <input name="shortdescription" type="text" class="form-control" value="{{ old('shortdescription') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea type="text" name="description" id="shortdescription" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="categoryimage" class="form-label">Image</label>
                                                            <input class="form-control" type="file" id="categoryimage" name="categoryimage">
                                                        </div>
                                                </div>   
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="banner" class="form-label">Banner Image</label>
                                                            <input class="form-control" type="file" id="banner" name="banner">
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