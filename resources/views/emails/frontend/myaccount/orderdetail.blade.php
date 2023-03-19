@extends('frontend.mainmaster')
@section('content')
    <main class="main-container profilearea">
    <div class="myaccount-wrap">
        <div class="container">
            <div class="myaccount-content-block">    
                @include('frontend.myaccount.leftsidebar')

                <div class="right-con orders-con">
                    <p class="slingtag">Order {{ $order->orderno }} was placed on {{ $order->order_date }} and is currently {{ ucfirst($order->status) }}.</p>
                    <h3>Order details</h3>
                    <div class="orders-deatils-1 row">
                        <div class="order-content col-md-12 col-sm-12">
                            <div class="order-content-details">
                                <table class="table ps-table ps-table--product">
                                 <thead>
                                     <tr>
                                         <th class="th-ps-product__thumbnail"></th>
                                         <th class="ps-product__name">Product name</th>
                                         <th class="ps-product__quantity">Quantity</th>
                                         <th class="ps-product__quantity">Price</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     
                                     @foreach($orderitems as $orderitem)
                                         <tr>
                                         <td>
                                             <div class="">
                                                 <a class="ps-product__image" href="{{route('productdetail',$orderitem->slug)}}">
                                                     <figure><img src="{{ asset('storage/uploads/product/'.$orderitem->productimage) }}" alt></figure>
                                                 </a>
                                             </div>
                                         </td>
                                         <td class="ps-product__name"> <a href="{{route('productdetail',$orderitem->slug)}}">{{$orderitem->productname}}</a>
                                         @if($orderitem->optionname!='')
                                         <br><span>Option : {{$orderitem->optionname}}</span>
                                          @endif
                                         </td>

                                         <td class="ps-product__quantity">
                                             <p>{{$orderitem->qty}}<p>
                                         </td>
                                         <td class="ps-product__quantity">
                                             <p>${{$orderitem->price}}<p>
                                         </td>

                                     </tr>

                                     @endforeach

                                 </tbody>
                             </table>
                                
                            </div>
                        </div>
                        </div>

                        <div class="orders-deatils-1 row" style="position :relative;left: 51.5%;">
                        <div class="order-content col-md-6 col-sm-12">
                            <div class="order-content-details">
                                <h4>Sub Total : ${{ $order->subtotal }}</h4>
                                @if($order->discountamount!=NULL)
                                <h4>Discount  @if($order->couponcode!=NULL)
                                            ({{ $order->couponcode }})
                                            @endif
                                    
                                    : ${{ $order->discountamount }}</h4>
                                @endif
                               
                                <h4>Total : ${{ $order->totalamount }}</h4>
                                 <h4>Payment Type : {{ $order->payment_type }}</h4>
                                 @if($order->payment_type=='Purchase Order')
                                    @if($order->purchaseno!='')
                                        <h4>Purchase Order No : {{ $order->purchaseno }}</h4>
                                    @endif
                                    @if($order->purchasedoc!='')
                                        <?php  $exists = Storage::disk('public')->exists('/uploads/orders/'.$order->purchasedoc);?>
                                        @if($exists && $order->purchasedoc!=NULL)
                                            <h4>Purchase Order : 
                                                 <a href="{{ asset('storage/uploads/orders/'.$order->purchasedoc) }}" target="_blank" class=""/>Click Here</a>
                                            </h4>
                                        @endif
                                    @endif
                                 @endif
                                  @if(!empty($orderpaymentdetail) && $order->payment_type=='Online Paid')
                                    <h4>Payment Method : {{ $orderpaymentdetail->payment_method }}</h4>
                                    <h4>Transaction NO : {{ $orderpaymentdetail->txn_id }}</h4>
                                    <!--<h4>Transaction Status : {{ $orderpaymentdetail->txn_status }}</h4>-->
                                @endif
                            </div>
                        </div>
                       
                    </div>
                    <br>
                    <div class="orders-details row">
                         <div class="order-content col-md-4 col-sm-12">
                            <div class="order-content-details">
                                <h4>Billing Address</h4>
                                <p id="order-p">{{ $order->bfirstname }} {{ $order->blastname }}</p>
                                <p id="order-p"> {{ $order->bstreetaddress1 }}</p>
                                <p id="order-p"> {{ $order->bstreetaddress2 }}</p>
                                <p id="order-p"> {{ $order->bcity }} {{ $order->bpostcode }}</p>
                                <p id="order-p"> {{ $order->bcountry }}</p>
                                <p id="order-p"> {{ $order->email }}</p>
                            </div>
                        </div>
                        <div class="order-content col-md-4 col-sm-12">
                            <div class="order-content-details">
                                <h4>Shipping Address</h4>
                                <p id="order-p">{{ $order->sfirstname }} {{ $order->slastname }}</p>
                                <p id="order-p"> {{ $order->sstreetaddress1 }}</p>
                                <p id="order-p"> {{ $order->sstreetaddress2 }}</p>
                                <p id="order-p"> {{ $order->scity }} {{ $order->spostcode }}</p>
                                <p id="order-p"> {{ $order->scountry }}</p>
                            </div>
                        </div>

                        @if(!empty($order->trackingurl))
                        <div class="order-content col-md-2 col-sm-12">
                            <a href="{{$order->trackingurl}}" target="_blank" style="display: table-cell;vertical-align: middle;" class="btn btn-outline-info">Track Package</a>
                        </div>
                        @endif

                        <div class="order-content col-md-2 col-sm-12">
                            <a href="{{route('invoice',$order->id)}}" style="display: table-cell;vertical-align: middle;" class="btn btn-outline-info">View/Print Invoice</a>
                        </div>

                        

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection