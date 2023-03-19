@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">News</h4>
                                    <div class="page-title-right">
                                        <a href="{{ route('addnews') }}" class="btn btn-primary waves-effect waves-light">Add News</a>
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
                                        <h4 class="card-title mb-4">Edit News</h4>
                                       
                                        <form action="{{ route('updatenews',$news->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$news->id}}"/>
                                            <input type="hidden" name="oldimage" value="{{$news->bannerimage}}"/>
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input name="title" type="text" class="form-control" id="newstitle" value="{{ $news->title}} ">
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
                                                        <input name="slug" type="text" class="form-control" id="slug" value="{{ $news->slug}} ">
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
                                                        <textarea type="text" name="description" id="shortdescription" class="form-control" placeholder="Description">{{ $news->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="bannerimage" class="form-label">Image</label>
                                                            <input class="form-control" type="file" id="bannerimage" name="bannerimage">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bannerimagealttext" class="form-label">Image Alt Text</label>
                                                            <input name="bannerimagealttext" type="text" class="form-control" id="bannerimagealttext" value="{{$news->bannerimagealttext}}">
                                                            @error('bannerimagealttext')
                                                                <span class="input-invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <?php  $exists = Storage::disk('public')->exists('/uploads/news/'.$news->bannerimage);?>
                                                            @if($exists && $news->bannerimage!=NULL)
                                                                <img src="{{ asset('storage/uploads/news/'.$news->bannerimage) }}" width="" height="150"/>
                                                            @else
                                                                
                                                            @endif
                                                        </div>
                                                        
                                                </div>   
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select id="newsstatus" class="form-select" name="status">
                                                            <option value="1" {{ $news->status == '1' ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $news->status == '0' ? 'selected' : '' }}>Inactive</option>

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
                                                                <input name="metatitle" type="text" class="form-control" id="metatitle" value="{{$news->metatitle}}">
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
                                                                <input name="metakeywords" type="text" class="form-control" id="metakeywords" value="{{$news->metakeywords}}">
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
                                                                <textarea name="metadescription" id="metadescription" class="form-control" placeholder="Description">{{$news->metadescription}}</textarea>
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