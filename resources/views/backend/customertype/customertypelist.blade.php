@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Customer Types</h4>

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
                                            @foreach($customertypes as $customertype)
                                            <tr>
                                                <td>{{ $customertype->ctname }}</td>
                                                <td>{{ $customertype->description }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editcustomertype',$customertype->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deletecustomertype',$customertype->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
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
                                        <h4 class="card-title mb-4">Add Customer Type</h4>
                                        
                                        <form action="{{ route('addcustomertype') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="ctname" class="form-label">Name</label>
                                                <input name="ctname" type="text" class="form-control" id="ctname">
                                                @error('ctname')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Details</label>
                                                <input name="description" type="text" class="form-control" id="description">
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