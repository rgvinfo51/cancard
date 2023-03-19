@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Applications</h4>
                                     <div class="page-title-right">
                                            <a href="{{ route('allapplications') }}" class="btn btn-primary waves-effect waves-light">View All Applications</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Edit Application</h4>
                                       
                                        <form action="{{ route('updateapplication',$application->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$application->id}}"/>
                                            <input type="hidden" name="oldbanner" value="{{$application->banner}}"/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="applicationname" class="form-label">Name</label>
                                                    <input name="applicationname" type="text" class="form-control" id="applicationname" value="{{ $application->applicationname}} ">
                                                    @error('applicationname')
                                                        <span class="input-invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="slug" class="form-label">Slug</label>
                                                            <input name="slug" type="text" class="form-control" id="slug" value="{{ $application->slug}} ">
                                                            @error('slug')
                                                                <span class="input-invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="applicationinfo" class="form-label">Short Description</label>
                                                    <input name="applicationinfo" type="text" class="form-control" id="applicationinfo" value="{{ $application->applicationinfo}} ">
                                                    @error('applicationinfo')
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
                                                        <textarea type="text" name="description" id="shortdescription" class="form-control" placeholder="Description">{{ $application->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="banner" class="form-label">Banner Image</label>
                                                            <input class="form-control" type="file" id="banner" name="banner">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="banneralttext" class="form-label">Banner Image Alt Text</label>
                                                            <input name="banneralttext" type="text" class="form-control" id="banneralttext" value="{{$application->banneralttext}}">
                                                            @error('banneralttext')
                                                                <span class="input-invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <?php  $exists = Storage::disk('public')->exists('/uploads/applicationbanner/'.$application->banner);?>
                                                            @if($exists && $application->banner!=NULL)
                                                                <img src="{{ asset('storage/uploads/applicationbanner/'.$application->banner) }}" width="" height="150"/>
                                                            @else
                                                                
                                                            @endif
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select id="catstatus" class="form-select" name="status">
                                                            <option value="1" {{ $application->status == '1' ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $application->status == '0' ? 'selected' : '' }}>Inactive</option>

                                                        </select>
                                                        @error('status')
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
                                                                <input name="metatitle" type="text" class="form-control" id="metatitle" value="{{$application->metatitle}}">
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
                                                                <input name="metakeywords" type="text" class="form-control" id="metakeywords" value="{{$application->metakeywords}}">
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
                                                                <textarea name="metadescription" id="metadescription" class="form-control" placeholder="Description">{{$application->metadescription}}</textarea>
                                                                @error('metadescription')
                                                                    <span class="input-invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                            <div class="col-md-6">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
</div>
@endsection