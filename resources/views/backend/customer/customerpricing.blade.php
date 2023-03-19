@extends('admin.adminmaster')

@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Custom Pricing | {{ $customerdetails->email }} | {{ $customerdetails->name }}</h4>
                                    <div class="page-title-right">
                                            <a href="{{ route('editcustomer',$customerdetails->id) }}}" class="btn btn-primary waves-effect waves-light"> Back</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <form action="{{ route('updatecustomerpricing',$customerdetails->id) }}" method="post" enctype="multipart/form-data">
                             <input type="hidden" name="cid" value="{{ $customerdetails->id }}">
                                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Discount Price</th>
                                                <th>Custom Price</th>
                                                <th>Custom Discount Price</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                            @php
                                            $customprice='';
                                            $customdiscountprice='';
                                            @endphp
                                            <tr>
                                                <td>{{ $product->productname }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->price }}</td>
                                                 @foreach($customerpricing as $customerprice)
                                                 
                                                    @if($customerprice->productid==$product->id)
                                                    @php
                                                       $customprice=$customerprice->price;
                                                       $customdiscountprice=$customerprice->discountprice;
                                                       @endphp
                                                        @break
                                                    @endif
                                                @endforeach
                                                <td><input id="discount" name="price[{{ $product->id }}]" type="text" class="form-control" value="{{ $customprice }}"></td>
                                                <td><input id="discount" name="discountprice[{{ $product->id }}]" type="text" class="form-control" value="{{ $customdiscountprice }}"></td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                            </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                        </div> <!-- end row -->
                            </form>
        
</div>

@endsection