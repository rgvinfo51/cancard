@extends('admin.adminmaster')
@section('admincontent')

<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Orders</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                @if(!$orderlist->isEmpty())
                   
                @else
                     <span class="orders">
                        <i class="fas fa-check-circle" style="color: #103178;"></i>
                        No order has been made yet.
                    </span>
               @endif
                 <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;">Order NO</th>
                                <th style="font-weight: bold;">Name</th>
                                <th style="font-weight: bold;">Date</th>
                                <th style="font-weight: bold;">Status</th>
                                <th style="font-weight: bold;">Total</th>
                                <th style="font-weight: bold;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderlist as $order)
                            <tr>
                                <td>{{ $order->orderno }}</td>
                                <td>{{ $order->bfirstname }} {{ $order->blastname }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>${{ $order->totalamount }}</td>
                                <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('adminorderdetail',$order->id) }}" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-pencil font-size-18"></i></a>
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