@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Customer Types</h4>
                                     <div class="page-title-right">
                                            <a href="{{ route('allcustomertypes') }}" class="btn btn-primary waves-effect waves-light">View All Customer Types</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Edit Customer Type</h4>
                                       
                                        <form action="{{ route('updatecustomertype',$customertype->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$customertype->id}}"/>
                                            <div class="mb-3">
                                                <label for="ctname" class="form-label">Name</label>
                                                <input name="ctname" type="text" class="form-control" id="ctname" value="{{ $customertype->ctname}} ">
                                                @error('ctname')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Details</label>
                                                <input name="description" type="text" class="form-control" id="description" value="{{ $customertype->description}} ">
                                                @error('description')
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