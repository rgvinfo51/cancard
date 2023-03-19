@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">News</h4>
                                    <div class="page-title-right">
                                        <a href="{{ route('allnews') }}" class="btn btn-primary waves-effect waves-light">View All News</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Add News</h4>
                                        
                                        <form action="{{ route('storenews') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input name="title" type="text" class="form-control" id="newstitle">
                                                        @error('title')
                                                            <span class="input-invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
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
                                                            <label for="bannerimage" class="form-label">Image</label>
                                                            <input class="form-control" type="file" id="bannerimage" name="bannerimage">
                                                        </div>
                                                </div>   
                                                <div class="col-md-6">
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