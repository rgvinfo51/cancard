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
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                            @foreach($news as $newsdetail)
                                            <tr>
                                                <td>{{ $newsdetail->title }}</td>
                                                <td>{{ $newsdetail->slug }}</td>
                                                <td> 
                                                    @if($newsdetail->status)
                                                       <span class="badge bg-success">Active</span>
                                                     @else
                                                         <span class="badge bg-danger">Inactive</span>
                                                     @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editnews',$newsdetail->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deletenews',$newsdetail->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                        </div> <!-- end row -->
        
</div>

@endsection