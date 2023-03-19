@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                         <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Customers</h4>
                                    <div class="page-title-right">
                                            <a href="{{ route('addcustomer') }}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus me-1"></i> New Customers</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Customer No</th>
                                                        <th>Company Name</th>
                                                        <th>Last Ordered On</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customers as $customer)
                                                    
                                                    
                                                     
                                                    <tr>
                                                       
                                                        <td>{{$customer->name}}</td>
                                                        <td>
                                                            <p class="mb-0">{{$customer->email}}</p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-1">{{$customer->phoneno}}</p>

                                                        </td>
                                                        <td>
                                                            <p class="mb-1">{{$customer->customerno}}</p>

                                                        </td>
                                                        <td>
                                                            <p class="mb-1">{{$customer->company}}</p>

                                                        </td>
                                                        <td>
                                                            
                                                            @if(!empty($customer->order_id))
                                                            <div class="d-flex gap-3">
                                                                <a href="{{ route('adminorderdetail',$customer->order_id) }}" class="btn btn-success waves-effect waves-light">Last Order On</a>
                                                            </div>
                                                            @endif

                                                        </td>
                                                        
                                                        <td>    
                                                                @if($customer->status==1)
                                                                    <span class="badge badge-pill badge-soft-success font-size-12">Active</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-soft-danger font-size-12">Inactive</span>
                                                                @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-icon btn-success" href="{{route('editcustomer',$customer->id)}}"><i class="bx bx-edit"></i></a>
                                                                <a class="btn btn-icon btn-danger" href="{{route('deletecustomer',$customer->id)}}" onclick="return confirm('Are you sure you want to delete this product?');"><i class="bx bx-trash"></i></a>
                                                            
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        </div>
                        @endsection