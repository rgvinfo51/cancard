@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Vendors</h4>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($vendors as $vendor)
                                            <tr>
                                                <td>{{ $vendor->vendorname }}</td>
                                                <td>{{ $vendor->vendorinfo }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editvendor',$vendor->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deletevendor',$vendor->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Add Vendor</h4>
                                        
                                        <form action="{{ route('addvendor') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="vendorname" class="form-label">Name</label>
                                                <input name="vendorname" type="text" class="form-control" id="vendorname">
                                                @error('vendorname')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="vendorinfo" class="form-label">Details</label>
                                                <input name="vendorinfo" type="text" class="form-control" id="vendorinfo">
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