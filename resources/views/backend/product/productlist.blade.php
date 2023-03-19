@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Product</h4>
                                    <div class="page-title-right">
                                            <a href="{{ route('addproduct') }}" class="btn btn-primary waves-effect waves-light">Add Product</a>
                                            <a href="{{ route('exportproducts') }}" class="btn btn-primary waves-effect waves-light">Export All Product</a>
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
                                                <th>Slug</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->productname }}</td>
                                                <td>{{ $product->slug }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{ route('editproduct',$product->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                        <a href="{{ route('deleteproduct',$product->id) }}" class="btn btn-danger waves-effect waves-light deleteaction"><i class="mdi mdi-delete font-size-18"></i></a>
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