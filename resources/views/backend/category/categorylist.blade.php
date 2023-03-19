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
                                                <th>Parent Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $parentcategories=$categories;
                                                @endphp
                                            @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td> 
                                                    @if($category->parentid==null)
                                                        None
                                                     @else
                                                        @foreach($parentcategories as $parentcategory)
                                                            @if($category->parentid==$parentcategory->id)
                                                            {{$parentcategory->name}}
                                                            @endif
                                                        @endforeach
                                                         
                                                     @endif
                                                </td>
                                                
                                                <td> 
                                                    @if($category->status)
                                                       <span class="badge bg-success">Active</span>
                                                     @else
                                                         <span class="badge bg-danger">Inactive</span>
                                                     @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editcategory',$category->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deletecategory',$category->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
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