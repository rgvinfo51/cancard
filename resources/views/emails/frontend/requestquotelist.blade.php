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
                            <h1 class="ps-banner__title text-white">Request a Quote</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
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
               @if(!$quoteitems->isEmpty())
               
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="cart-content-block">
                        <form method="post" name="updatequoteform" id="updatequoteform" action="{{route('updatequote')}}">
                            @csrf
                        <div class="ps-shopping__table">
                            
                            <table class="table ps-table ps-table--product">
                                <thead>
                                    <tr>
                                        <th class="th-ps-product__remove"></th>
                                        <th class="th-ps-product__thumbnail"></th>
                                        <th class="ps-product__name">Product name</th>
                                        <th class="ps-product__quantity">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $subtotalamount=0;
                                     $totalamount=0;
                                    @endphp
                                    @foreach($quoteitems as $quoteitem)
                                        <tr>
                                        <td class="ps-product__remove"> 
                                            <input type="hidden" name="quoteid[{{$quoteitem->id}}]" value="{{$quoteitem->id}}">
                                            <a href="{{route('removequoteitem',$quoteitem->id)}}"><i class="icon-cross"></i></a>
                                        </td>
                                        <td>
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{route('productdetail',$quoteitem->slug)}}">
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$quoteitem->productimage);
                                                    if($quoteitem->productimagealttext!='')
                                                    $imgtitle=$quoteitem->productimagealttext;
                                                    // else if($quoteitem->metatitle!='')
                                                    // $imgtitle=$quoteitem->metatitle;
                                                    else
                                                    $imgtitle=$quoteitem->productname;
                                                    ?>
                                                    @if($exists && $quoteitem->productimage!=NULL)
                                                        <figure><img src="{{ asset('storage/uploads/product-thumbnail/'.$quoteitem->productimage) }}" alt="{{$imgtitle}}"></figure>
                                                    @else
                                                         <figure><img src="{{ asset('storage/uploads/product/'.$quoteitem->productimage) }}" alt="{{$imgtitle}}"></figure>
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td class="ps-product__name"> <a href="{{route('productdetail',$quoteitem->slug)}}">{{$quoteitem->productname}}</a>
                                        @if($quoteitem->optionname!='')
                                        <br><span>Option : {{$quoteitem->optionname}}</span>
                                         @endif
                                        </td>
                                        
                                        <td class="ps-product__quantity">
                                            <div class="def-number-input number-input safari_only">
                                                <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                <input class="quantity" min="1" name="quantity[{{$quoteitem->id}}]" value="{{$quoteitem->qty}}" type="number">
                                                <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                            </div>
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
                            
                            <div class="ps-shopping__button">
                                <button class="btn btn-secondary" type="submit" name="updatequoteitems" value="updatequoteitems">Update quote</button>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-5">
                <div class="text quote-form-block">
                    <div class="quoteform">
                        <form action="{{route('requestquote')}}" method="post">
                            @csrf
                            <div class="contact-input-group">
                            <input class="contact-input" type="text" name="firstname" placeholder="First Name" value="{{old('firstname')}}" required>
                            @error('firstname')
                                <span class="input-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="contact-input-group">
                            <input class="contact-input" type="text" name="lastname" placeholder="Last Name" value="{{old('lastname')}}" >
                            @error('lastname')
                                <span class="input-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </div>
                        
                            <div class="contact-input-group">
                            <input class="contact-input" type="email" name="email" placeholder="Your email" value="{{old('email')}}" required>
                            @error('email')
                                <span class="input-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            
                            <div class="contact-input-group">
                            <textarea class="contact-input textarea"  name="message" placeholder="Your message" ></textarea>
                            </div> 

                            <div class="contact-input-group">
                            <input class="contact-btn" type="submit" name="" value="Submit">
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
               @else
               <div class="emptycartmessage">
                    <div class="emptycartcontent">
                        <i class="icon-cart-empty"></i>
                        <p>You have not made any quote requests</p>
                        <a class="btn btn-primary" href="{{route('homepage')}}">Continue To Shopping</a>
                    </div>
                </div>
               @endif
            </div>
           
        </div>
    </div>
</div>

@endsection