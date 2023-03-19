@extends('frontend.mainmaster')
@section('content')

<main class="main-container myorderhere">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con orders-con">
                <h2 id="order-title">
                    <div class="row">
                        <div class="col-md-8">My Orders</div>
                        <div class="col-md-4">
                            <form action="" method="POST">
                                @csrf
                                <input type="text" placeholder="Search order, PO" id="search_order" name="search_order" class="col-8">
                                <button class="btn btn-primary p-0">Search</button>
                            </form>
                        </div>
                    </div>
                </h2>
                @if(!$orderlist->isEmpty())
                   
                @else
                     <span class="orders">
                        <i class="fas fa-check-circle" style="color: #103178;"></i>
                        No order has been made yet.
                    </span>
               @endif
                <div class="orders-program">
                    <table class="orders-program-con table table-bordered" style="overflow: auto;">
                        <thead style="border-bottom: black 1px solid;">
                            <tr>
                                <th style="font-weight: bold;" width="200">Date</th>
                                <th style="font-weight: bold;" width="110">Order ID</th>
                                <th style="font-weight: bold;" width="100">PO</th>
                                <th style="font-weight: bold;" width="200">Ship To</th>
                                <th style="font-weight: bold;" width="200">Bill To</th>
                                <th style="font-weight: bold;">Status</th>
                                <th style="font-weight: bold;" width="300">Total (In CAD)</th>
                                <th style="font-weight: bold;" width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderlist as $order)
                            <tr style="font-size: 14px;">
                                <td width="200">{{ date("d F Y",strtotime($order->order_date)) }}</td>
                                <td>{{ ltrim($order->orderno, '#') }}</td>
                                <td>{{ $order->purchaseno }}</td>
                                <td>{{ $order->sstreetaddress1 }} {{ $order->sstreetaddress2 }} {{ (!empty($order->scity)) ? ',' : '' }} {{ $order->spostcode }}</td>
                                <td>{{ $order->bstreetaddress1 }} {{ $order->bstreetaddress2 }} {{ $order->bcity }}, {{ $order->bpostcode }}</td>
                                <td>{{ $order->status }}</td>
                                <td width="200">${{ $order->totalamount }}</td>
                                <td width="100"><a href="{{route('orderdetail',$order->id)}}"><button class="view-btn" style="border-radius: 5px !important;font-size: 15px;padding-bottom: 0px;">Details</button></a></td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection