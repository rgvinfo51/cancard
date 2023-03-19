@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Applications</h4>

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
                                                <th>slug</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($applications as $application)
                                            <tr>
                                                <td>{{ $application->applicationname }}</td>
                                                <td>{{ $application->slug }}</td>
                                                <td> @if($application->status)
                                                       <span class="badge bg-success">Active</span>
                                                     @else
                                                         <span class="badge bg-danger">Inactive</span>
                                                     @endif</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editapplication',$application->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deleteapplication',$application->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
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
                                        <h4 class="card-title mb-4">Add Application</h4>
                                        
                                        <form action="{{ route('addapplication') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="applicationname" class="form-label">Name</label>
                                                <input name="applicationname" type="text" class="form-control" id="applicationname">
                                                @error('applicationname')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug</label>
                                                <input name="slug" type="text" class="form-control" id="slug" value="{{old('slug')}}">
                                                @error('slug')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="applicationinfo" class="form-label">Short Description</label>
                                                <input name="applicationinfo" type="text" class="form-control" id="applicationinfo">
                                                @error('applicationinfo')
                                                    <span class="input-invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
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