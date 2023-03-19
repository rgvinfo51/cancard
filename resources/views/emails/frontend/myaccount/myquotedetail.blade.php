@extends('frontend.mainmaster')
@section('content')
    <main class="main-container myaccountquote">
    <div class="myaccount-wrap">
        <div class="container">
            <div class="myaccount-content-block">    
                @include('frontend.myaccount.leftsidebar')

                <div class="right-con orders-con">
                    <h3>Quote Details</h3>
                    <div class="orders-details row">
                        <div class="order-content col-md-6 col-sm-12">
                            <div class="order-content-details">
                                <h4>Quote ID : {{ $quote->quoteno }}</h4> 
                                <h4>Name : {{ $quote->firstname }} {{ $quote->lastname }}</h4>
                                <h4>Date : {{ $quote->created_at->format('d M Y') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="orders-deatils-1 row">
                       
                        <div class="order-content col-md-12 col-sm-12">
                            <div class="order-content-details">
                                <h4>Products</h4>
                            
                                <table class="table ps-table ps-table--product">
                                 <thead>
                                     <tr>
                                         <th class="th-ps-product__thumbnail"></th>
                                         <th class="ps-product__name">Product name</th>
                                         <th class="ps-product__quantity">Quantity</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     
                                     @foreach($quoteitems as $quoteitem)
                                         <tr>
                                         <td>
                                             <div class="">
                                                 <a class="ps-product__image" href="{{route('productdetail',$quoteitem->slug)}}">
                                                     <figure><img src="{{ asset('storage/uploads/product/'.$quoteitem->productimage) }}" alt></figure>
                                                 </a>
                                             </div>
                                         </td>
                                         <td class="ps-product__name"> <a href="{{route('productdetail',$quoteitem->slug)}}">{{$quoteitem->productname}}</a>
                                         @if($quoteitem->optionname!='')
                                         <br><span>Option : {{$quoteitem->optionname}}</span>
                                          @endif
                                         </td>

                                         <td class="ps-product__quantity">
                                             <p>{{$quoteitem->qty}}<p>
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
        </div>
    </div>
    </main>
@endsection