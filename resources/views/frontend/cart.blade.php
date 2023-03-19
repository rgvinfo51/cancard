@extends('frontend.mainmaster')
@section('content')

<div class="ps-shopping">
<div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                                <img class="" src="{{ URL::asset('frontend/img/slide1.jpg') }}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">Shopping cart</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container profilearea cartarea">
        <!-- <ul class="ps-breadcrumb">
            <li class="ps-breadcrumb__item"><a href="index.html">Home</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">Shopping cart</li>
        </ul> -->
        <!-- <h3 class="ps-shopping__title text-center bg-secondary text-white m-4">Shopping cart</h3> -->
        <div class="ps-shopping__content">
            <div class="row">
                 @if(session()->has('alertsuccess'))
                    <div class="alert alert-success">
                        {{ session()->get('alertsuccess') }}
                    </div>
                @endif
                @if(session()->has('alerterror'))
                    <div class="alert alert-error">
                        {{ session()->get('alerterror') }}
                    </div>
                @endif
               @if(!$cartitems->isEmpty())
               
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="cart-content-block">
                        <form method="post" name="updatecartform" id="updatecartform" action="{{route('updatecart')}}">
                            @csrf
                        <div class="ps-shopping__table">
                            
                            <table class="table ps-table ps-table--product">
                                <thead>
                                    <tr>
                                        <th class="th-ps-product__remove"></th>
                                        <th class="th-ps-product__thumbnail"></th>
                                        <th class="ps-product__name">Product name</th>
                                        <th class="ps-product__meta">Unit price</th>
                                        <th class="ps-product__quantity">Quantity</th>
                                        <th class="ps-product__subtotal">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $subtotalamount=0;
                                     $totalamount=0;
                                    @endphp
                                    @foreach($cartitems as $cartitem)
                                        <tr>
                                        <td class="ps-product__remove"> 
                                            <input type="hidden" name="cartid[{{$cartitem->id}}]" value="{{$cartitem->id}}">
                                            <a href="{{route('removecartitem',$cartitem->id)}}"><i class="icon-cross"></i></a>
                                        </td>
                                        <td>
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{route('productdetail',$cartitem->slug)}}">
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$cartitem->productimage);
                                                    if($cartitem->productimagealttext!='')
                                                    $imgtitle=$cartitem->productimagealttext;
                                                    // else if($cartitem->metatitle!='')
                                                    // $imgtitle=$cartitem->metatitle;
                                                    else
                                                    $imgtitle=$cartitem->productname;
                                                    ?>
                                                    @if($exists && $cartitem->productimage!=NULL)
                                                        <figure><img src="{{ asset('storage/uploads/product-thumbnail/'.$cartitem->productimage) }}" alt="{{$imgtitle}}"></figure>
                                                    @else
                                                         <figure><img src="{{ asset('storage/uploads/product/'.$cartitem->productimage) }}" alt="{{$imgtitle}}"></figure>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td class="ps-product__name"> <a href="{{route('productdetail',$cartitem->slug)}}">{{$cartitem->productname}}</a>
                                        @if($cartitem->optionname!='')
                                        <br><span>Option : {{$cartitem->optionname}}</span>
                                         @endif
                                        </td>
                                        <td class="ps-product__meta">  
                                            @if($cartitem->discountprice!='')
                                            <span class="ps-product__price sale" translate="no">${{$cartitem->discountprice}}</span><span class="ps-product__del" translate="no">${{$cartitem->price}}</span>
                                            @else
                                            <span class="ps-product__price" translate="no">${{$cartitem->price}}</span>
                                            @endif
                                        </td>
                                        <td class="ps-product__quantity">
                                            <div class="def-number-input number-input safari_only">
                                                <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                <input class="quantity" min="1" name="quantity[{{$cartitem->id}}]" value="{{$cartitem->qty}}" type="number">
                                                <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                            </div>
                                        </td>
                                        <td class="ps-product__subtotal" translate="no">
                                            @if($cartitem->discountprice!='')
                                                @php
                                                    $subtotalamount=$subtotalamount+($cartitem->discountprice * $cartitem->qty);
                                                @endphp
                                                ${{$cartitem->discountprice * $cartitem->qty}}
                                            @else
                                                @php
                                                    $subtotalamount=$subtotalamount+($cartitem->price * $cartitem->qty);
                                                @endphp
                                            ${{$cartitem->price * $cartitem->qty}}
                                            @endif
                                        </td>
                                    </tr>
                                        
                                    @endforeach
                                    @php
                                     $totalamount=$subtotalamount;
                                    @endphp
                                    
                                </tbody>
                            </table>
                                
                        </div>
                        <div class="ps-shopping__footer">
                            <div class="ps-shopping__coupon">
                                
                                <div id="removecoupondiv" style="{{  Session::has('coupon') ? "" : "display:none" }}">
                                <button class="btn btn-primary" type="button" onclick="couponRemove()">Remove coupon</button>
                                </div>
                               
                                <div id="couponField" style="{{  Session::has('coupon') ? "display:none" : "" }}">
                                <input class="form-control ps-input" type="text" placeholder="Coupon code" id="coupon_name">
                                <button class="btn btn-primary" type="button" onclick="applyCoupon()">Apply coupon</button>
                                </div>
                               
                            </div>
                            <div class="ps-shopping__button">
                                <a class="btn btn-secondary" href="{{route('clearcart')}}">Clear All</a>
                                <button class="btn btn-secondary" type="submit" name="updatecartitems" value="updatecartitems">Update cart</button>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="cart-total-block">
                        <div class="ps-shopping__label">Cart totals</div>
                        <div class="ps-shopping__box">
                            <div id="couponCalField">
                                <div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Subtotal</div>
                                    <div class="ps-shopping__price" translate="no">${{$subtotalamount}}</div>

                                </div>
                                @if(Session::has('coupon'))
                                    @php
                                        $couponname=session()->get('coupon' )['coupon_name'];
                                        $discount_amount=session()->get('coupon' )['discount_amount'];
                                        $totalamount=session()->get('coupon' )['total_amount'];
                                    @endphp
                                    <div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Coupon ({{$couponname}})</div>
                                    <div class="ps-shopping__price" translate="no">${{$discount_amount}}</div>

                                    </div>
                                @endif
                                <!--<div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Shipping</div>
                                    <div class="ps-shopping__price">$10.00</div>

                                </div>-->

                                <div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Total Amount</div>
                                    <div class="ps-shopping__price" translate="no">${{$totalamount}}</div>
                                </div>
                            </div>
                            <div class="ps-shopping__checkout">
                                <a class="btn btn-primary w-100 mb-3" href="{{route('checkout')}}">Proceed to checkout</a>
                                <a class="ps-shopping__link" href="{{route('homepage')}}">Continue To Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
               @else
               <div class="emptycartmessage">
                    <div class="emptycartcontent">
                        <i class="icon-cart-empty"></i>
                        <!-- <p>Cart is empty.</p> -->
                        <a class="btn btn-primary" href="{{route('homepage')}}">Continue To Shopping</a>
                    </div>
                </div>
               @endif
            </div>
           
        </div>
    </div>
</div>

@endsection