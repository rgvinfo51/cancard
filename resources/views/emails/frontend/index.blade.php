@extends('frontend.mainmaster')
@section('title')
Cancard Inc. : Tracking and Identity Solutions - Cancard Inc.
@stop

@section('metakeywords')

@stop

@section('description')
We are the CANCARD INC. We have been providing customers with superior quality Metal tag and plate embossers, Plastic card embossers, Label printers, ID printers, card solutions, Tags, Patient id wristbands, medication carts, procedure carts, computer workstation, multi-factor authentication, and expert consulting since 1989. If you need consultation on a project, wonderfully printed ID cards, printer, embossers, carts, tags,  you have come to the right place.
@stop

@section('content')
<style>
    @media screen and (max-width: 767px)
.ps-header {
    display: block;
    margin-top:30px;
}
@media screen and (max-width: 767px)
.head-container {
    display: none;
}
</style>
<div class="container mainheader">
<div class="ps-home ps-home--8">
    <div class="ps-home__content">
        <div class="container-fluid">
            <!-- <div class="ps-promo"><a class="ps-promo__item" href="#"><img class="ps-promo__text" src="{{ URL::asset('frontend/img/christmas-banner-txt.png') }}" alt><img class="ps-promo__banner" src="{{ URL::asset('frontend/img/christmas-banner-bg.jpg') }}" alt></a></div>
            <div class="ps-promo mobile"><a class="ps-promo__item" href="#"><img class="ps-promo__text" src="{{ URL::asset('frontend/img/christmas-banner-mobile-txt.png') }}" alt><img class="ps-promo__banner" src="{{ URL::asset('frontend/img/christmas-banner-mobile.jpg') }}" alt></a></div>
        -->    <section class="ps-section--banner ps-banner--container row"> 
                <div class="ps-section__overlay">
                    <div class="ps-section__loading"></div>
                </div>
                <div class="owl-carousel col-md-8 col-sm-12 pdr-0" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    <div class="ps-banner" style="background:#306A53;">
                        <div class="container-no-round">
                            <div class="ps-banner__block">
                                <div class="ps-banner__content">
                                    <h2 class="ps-banner__title text-white">Delivering innovative medication management, tracking, identification and decontamination solutions to healthcare systems. </h2>
                                    <a class="bg-warning ps-banner__shop" href="{{url('/application/healthcare')}}">Healthcare Products</a>

                                </div>
                                <div class="ps-banner__thumnail ps-banner__fluid"><img class="ps-banner__image" src="{{ URL::asset('frontend/img/slide1.jpg') }}" alt="alt" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-banner" style="background:#306A53;">
                        <div class="container-no-round">
                            <div class="ps-banner__block">
                                <div class="ps-banner__content">
                                    <h2 class="ps-banner__title text-white">Solving challenging metal marking, tracking and identifying needs for industrial, manufacturing, and construction customers.</h2>
                                    <a class="bg-warning ps-banner__shop" href="{{url('/application/industrial')}}">Industrial Products</a>

                                </div>
                                <div class="ps-banner__thumnail ps-banner__fluid"><img class="ps-banner__image" src="{{ URL::asset('frontend/img/slide3.jpg') }}" alt="alt" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-banner" style="background:#306A53;">
                        <div class="container-no-round">
                            <div class="ps-banner__block">
                                <div class="ps-banner__content">
                                    <h2 class="ps-banner__title text-white">Cancard offers collaborative solutions to an unique and diverse markets it serves, focusing attention on the specific needs and requirements of each client. </h2>
                                    <a class="bg-warning ps-banner__shop" href="{{url('/products')}}">All Products</a>

                                </div>
                                <div class="ps-banner__thumnail ps-banner__fluid"><img class="ps-banner__image" src="{{ URL::asset('frontend/img/slide2.jpg') }}" alt="alt" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ps-login col-md-4 col-sm-12 pdl-0">
                    <div class="home-login-register-wrap">
                    <div class="mx-auto home-login-register-block">
                        <div class="card-header border-bottom-0 bg-transparent">
                        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold active show" id="pills-register-tab" data-toggle="pill"
                              href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" id="pills-login-tab" data-toggle="pill"
                              href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="false">Login</a>
                            </li>
                            
                          
                        </ul>
                      </div>
                        <div class="card-body pb-4">
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade login-info-block" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                               @include('frontend.homelogin')
                            </div>

                            <div class="tab-pane fade register-info-block show active" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                                <ul class="register-info-list"><h3>Register to access these great benefits!</h3>
                                        <li><i class="icon-check"></i> Discounted pricing</li>
                                        <li><i class="icon-check"></i> Quick quotes and checkout</li>
                                        <li><i class="icon-check"></i> Order history and tracking</li>
                                        <li><i class="icon-check"></i> Invoice copies</li>
                                        <li><i class="icon-check"></i> and more...</li>
                                </ul>   
                                <div class="text-left pt-2 pb-1 home-reg-link-block">
                                   <a href="{{route('register')}}" class="btn btn-secondary" data-toggle="modal" data-target="#loginpopup"><i class="icon-user"></i> Register</a>
                                </div>
                                <!--<div class="text-center pt-2 pb-1 d-flex home-reg-action-block">
                                    <a href="{{route('login')}}" class="btn btn-primary mr-3"><i class="icon-lock"></i> Login</a>
                                    <a href="{{route('register')}}" class="btn btn-secondary" data-toggle="modal" data-target="#loginpopup"><i class="icon-user"></i> Register</a>
                                </div>-->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <form method="get">
                        <div class="form-group">
                            <label>Username or Email Address</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password">
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox">
                            <label>Remember Me</label>
                        </div>
                        <button class="ps-btn ps-btn--warning" type="submit">Log In</button>
                    </form> -->
                </div>
            </section>
        </div>

        <section class="welcome-info-wrap">
            <div class="ps-promo ps-home__promo">
                <div class="home-products-block">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="cancard-products-block brd-right">
                                <h2><span>Cancard</span> <a href="{{url('application/healthcare')}}">Healthcare</a></h2>
                                <p>Cancard is a market-leading provider of a broad portfolio of innovative products, including medication and procedure carts, patient wrist bands, patient ID systems, healthcare label printers, and many more. Our dedicated team of healthcare sales and service team strives every day to solve the unmet needs of our physicians, and hospital customers and ensure you have the products to deliver the best care for your patients. Go to our <a href="{{url('application/healthcare')}}">healthcare page</a> to learn more on how we can help.</p>
                                <ul class="cancard-product-lists">
                                    <li><i class="icon-chevron-right"></i> <span>Digital Health - Telemedicine</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Medication Management</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Patient IDs</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Wrist Bands</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Procedure Carts</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Computer Workstations</span></li>
                                </ul>
                                <!--<ul class="cancard-products-logo">
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo6.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo11.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo3.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo13.png') }}" alt="" /></li>
                                </ul>-->
                                <a href="{{url('application/healthcare')}}" class="btn btn-primary forhealthcare-btn">Click Here<br> For Cancard Healthcare Products</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="cancard-products-block">
                                <h2><span>Cancard</span> <a href="{{url('application/industrial')}}">Industrial</a></h2>
                                <p>Cancard is a leading provider of metal marking, identification, and traceability systems used in heavy industrial, steel construction, and manufacturing applications. We offer a complete portfolio of metal tag embossers, laser marking printers, and metal tags to meet every unique need of our customers. We support our customers with industry renowned, and dedicated field-based service, to help you maintain uptime and ROI on your equipment. Go to our <a href="{{url('application/industrial')}}">Industrial page</a> to learn more on how we can help.</p>
                                <ul class="cancard-product-lists">
                                    <li><i class="icon-chevron-right"></i> <span>Metal Tag Embossers</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Laser Marking</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Label Printers</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Metal Tags</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Access Management</span></li>
                                    <li><i class="icon-chevron-right"></i> <span>Photo ID Cards</span></li>
                                </ul>
                                 <!--<ul class="cancard-products-logo">
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo1.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo10.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo4.png') }}" alt="" /></li>
                                    <li><img src="{{ URL::asset('frontend/img/ptlogo2.png') }}" alt="" /></li>
                                </ul>-->
                                <a href="{{url('application/industrial')}}" class="btn btn-primary forhealthcare-btn">Click Here<br> For Cancard Industrial Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ps-section--sellers bestsellers">
            <h3 class="ps-section__title">Best Selling Products</h3>
            <div>
                <div class="owl-carousel" data-owl-auto="false" data-owl-loop="false" data-owl-speed="13000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="2" data-owl-item-lg="3" data-owl-item-xl="4"data-owl-item-xxl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                             @foreach($topproducts as $product)
                             
                                <div class="ps-section__product">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{route('productdetail',$product->slug)}}">
                                                <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$product->productimage);
                                                        if($product->productimagealttext!='')
                                                        $imgtitle=$product->productimagealttext;
                                                        else if($product->metatitle!='')
                                                        $imgtitle=$product->metatitle;
                                                        else
                                                        $imgtitle=$product->productname;
                                                        
                                                ?>
                                                    @if($exists && $product->productimage!=NULL)
                                                        <figure><img class="" src="{{ asset('storage/uploads/product-thumbnail/'.$product->productimage) }}" alt="{{$imgtitle}}"/></figure>
                                                    @else
                                                         <figure><img class="" src="{{ asset('storage/uploads/product/'.$product->productimage) }}" alt="{{$imgtitle}}"/></figure>
                                                    @endif
                                            </a>
                                            
                                            <!--<div class="ps-product__actions">
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                            </div>
                                            <div class="ps-product__badge">
                                                <div class="ps-badge ps-badge--sold">Sold Out</div>
                                            </div>-->
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title"><a href="{{route('productdetail',$product->slug)}}">
                                            @php
                                                $checksubcat=0;
                                            @endphp        
                                            @foreach($headersubcategories as $category)
                                                @if($product->catids==$category->id)
                                                    {{ ucfirst(strtolower($category->name)) }}
                                                    @php
                                                    $checksubcat=1;
                                                    @endphp
                                                    @break
                                                @endif
                                             @endforeach
                                                @if($checksubcat==0)
                                                    @foreach($headercategories as $category)
                                                        @if($product->catids==$category->id)
                                                            {{ ucfirst(strtolower($category->name)) }}
                                                        @break
                                                        @endif
                                                     @endforeach
                                                @endif
                                            - {{$product->productname}}</a></h5>
                                            @auth
                                            @if(!$product->hideprice)
                                            <div class="ps-product__meta" translate="no">

                                                    @if($product->discountprice!='')
                                                    <span class="ps-product__price sale" id="productdiscountprice">${{$product->discountprice}}</span><span class="ps-product__del" id="productprice">${{$product->price}}</span>
                                                    @else
                                                    <span class="ps-product__price sale" id="productprice">${{$product->price}}</span></span>
                                                    @endif
                                            </div>
                                            @endif

                                            @endauth
                                        </div>
                                        <div class="shortdescription {{$product->catids}}">
                                            @php 
                                                $shortdescrition=strip_tags(htmlspecialchars_decode($product->shortdescription));
                                                $checksubcat=0;
                                            @endphp
                                            
                                            </div>
                                    </div>
                                </div>
                              @endforeach
                        </div>
            </div>
            
        </section>
        
    </div>

    <section class="ouraboutsec ps-about--info container-fluid">
        <h2 class="ps-about__title">About Us</h2>
        <div class="ps-about__extent">
            <section class="ps-about--info container-fluid">
                <div class="ps-about__extent">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="ps-about__subtitle text-left">At Cancard, we like to say that our products and services revolve around marking, identifying and tracking (MIT for short). We strive to fulfill that purpose as comprehensively as possible.</h6>
                            <p>Our journey began in 1989 as Canadian Card Systems Inc., a start-up dealer for plastic card embossers and imprinters. With our focus on maintain customer uptime, through best in class onsite service, Cancard saw rapid adoption and grew into the multi-faceted technology sales and service company.</p>
                            <p>Our ambition to meet growing needs of our customer have helped us expand our core competencies in various areas like medication management, procedure carts, airborne decontamination, secure identification solutions, mobile ID, access management software and solutions, plastic card embossing, metal tag embossing, laser and thermal metal surface marking, employee picture ID, and many other solutions and services.</p>
                            <p>Lastly, Cancard is born and raised in Canada and aspires to bring the Canadian values in our day to day operations and how we treat our customers, employees and vendors fairly.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="about-img-block">
                                <img src="{{ URL::asset('frontend/img/about1.jpg') }}" alt="" />
                            </div>
                        </div>
                    </div>
                    <section class="mt-5 container-fluid">

                    </section>
                </div>
            </section>
        </div>
    </section>
    
    <section class="ourindsec ps-about--info container-fluid">
        <h2 class="ps-about__title">Industries We Serve</h2>
        <div class="ps-about__extent">
            <section class="ps-weserve--info container-fluid">
                <div class="ps-weserve">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-heartbeat"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Healthcare</h6></div>
                            <div class="weserveinfo">Healthcare organizations rely on Decontamination, Tracking, and Identity solutions offered by Cancard Inc.</div>
                        </div>
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-sitemap"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Corporate</h6></div>
                            <div class="weserveinfo">Cancard Inc. Tracking and Identity solution offers vital tool for the variety of businesses we support.</div>
                        </div>
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-book-open"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Education</h6></div>
                            <div class="weserveinfo">Colleges or universities can easily implement identity systems that perform basic Identity management.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-landmark"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Central Issuance</h6></div>
                            <div class="weserveinfo">Cancard Inc. Identity Management offers high definition and edge-to-edge printing technology for Central Issuance</div>
                        </div>
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-stamp"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Government</h6></div>
                            <div class="weserveinfo">Government agencies and departments value the quality and security Cancard's identification solutions provide.</div>
                        </div>
                        <div class="col-md-4">
                            <div class="weserveicon"><i aria-hidden="true" class="fas fa-industry"></i></div>
                            <div class="weserveheader"><h6 class="ps-weserve-subtitle">Industrial Goods</h6></div>
                            <div class="weserveinfo">Solving challenging metal marking, tracking and identifying needs for manufacturing and industrial customers.</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <section class="ournewssec ps-about--info container-fluid">
                <h2 class="ps-about__title">News & Events</h2>
                <div class="ps-about__extent">
                    <section class="ps-weserve--info container-fluid">
                        <div class="ps-weserve">
                            <div class="row">
                                <div class="col-md-12 i5">
                                    <div class="ibox clearfix">
                                        <!-- <div class="ilt">
                                            @foreach($news as $newsdetail)
                                                <?php  $exists = Storage::disk('public')->exists('/uploads/news/'.$newsdetail->bannerimage);?>
                                                @if($exists && $newsdetail->bannerimage!=NULL)
                                                        <img data-src="{{ asset('storage/uploads/news/'.$newsdetail->bannerimage) }}" class="lazyloaded" alt="{{ $newsdetail->title }}" src="{{ asset('storage/uploads/news/'.$newsdetail->bannerimage) }}">
                                                @endif
                                            @endforeach
                                        </div>
                                        <ul class="irt">
                                        @foreach($news as $newsdetail)
                                                <li class="">
                                                    <div class="newstitle"><a href="{{route('newsdetail',$newsdetail->slug)}}">{{ $newsdetail->title }}</a></div>
                                                    <div class="newssummary">{!! Str::words($newsdetail->description, 15, ' ...') !!}</div>
                                                    <div class="newsdate">{{ date('F d, Y', strtotime($newsdetail->created_at)) }}</div>
                                                    <div class="newsbtn"><a href="{{route('newsdetail',$newsdetail->slug)}}" class="btn btn-primary">Read More</a></div>
                                                    
                                                </li>
                                            @endforeach
                                        </ul> -->

                                        <div class="newCard-list-block">
                                             @foreach($news as $newsdetail)
                                                 <?php  $exists = Storage::disk('public')->exists('/uploads/news/'.$newsdetail->bannerimage);?>
                                                <div class="newCard-item">
                                                    <div class="newCard-img-block">
                                                        <?php
                                                        if($newsdetail->bannerimagealttext!='')
                                                         $imgtitle=$newsdetail->bannerimagealttext;
                                                        else
                                                        $imgtitle=$newsdetail->title;
                                                         ?>
                                                        @if($exists && $newsdetail->bannerimage!=NULL)
                                                            <img src="{{ asset('storage/uploads/news/'.$newsdetail->bannerimage) }}" alt="{{$imgtitle}}">
                                                            @endif
                                                        <div class="newsdate">{{ date('F d, Y', strtotime($newsdetail->created_at)) }}</div>
                                                    </div>
                                                    <div class="newCard-info">
                                                        <div class="newstitle"><a href="{{route('newsdetail',$newsdetail->slug)}}">{{ $newsdetail->title }}</a></div>
                                                        <div class="newssummary">{!! Str::words($newsdetail->description, 50, ' ...') !!}</div>
                                                        <div class="newsbtn"><a href="{{route('newsdetail',$newsdetail->slug)}}" class="newsMore">Read More</a></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="newseventsbottom"><a href="{{route('news')}}" class="allnewsbtn btn btn-primary">Check All News & Events</a></div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
        </section>
    
               
</div>
</div>
<div class="modal fade" id="loginpopup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body p-0">
                        <button class="close ps-quickview__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-xl-12 register-form">
                                    <h4>Register</h4>
                                    <x-jet-validation-errors class="mb-4" />
                                    <form method="POST" action="{{ route('ajaxregister') }}" id='ajaxregisterform'>
                                    @csrf
                                    <section class="row">
                                     <div class="col-md-6">
                                    <x-jet-label for="name" value="{{ __('Contact Name*') }}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-jet-label for="posttitle" value="{{ __('Title/Role') }}" />
                                        <x-jet-input id="posttitle" class="block mt-1 w-full" type="text" name="posttitle" :value="old('posttitle')"  autofocus autocomplete="posttitle" />
                                    </div>
                                    </section>
                                    <section class="row">
                                    <div class="col-md-6">
                                        <x-jet-label for="email" value="{{ __('Email*') }}" />
                                        <x-jet-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required />
                                    </div>

                                    <div class="col-md-6">
                                        <x-jet-label for="phoneno" value="{{ __('Phone No*') }}" />
                                        <x-jet-input id="phoneno" class="block w-full" type="text" name="phoneno" :value="old('phoneno')" required autofocus autocomplete="phoneno" />
                                    </div>
                                    </section>
                                    <div>
                                        <x-jet-label for="company" value="{{ __('Company Name*') }}" />
                                        <x-jet-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required autofocus autocomplete="company" />
                                    </div>
                                    <div>
                                        <x-jet-label for="bill_address1" value="{{ __('Address') }}" />
                                        <x-jet-input id="bill_address1" class="block mt-1 w-full" type="text" name="bill_address1" :value="old('bill_address1')" autofocus autocomplete="bill_address1" />
                                    </div>
                                    <section class="row">
                                    <div class="col-md-6">
                                        <x-jet-label for="password" value="{{ __('Password*') }}" />
                                        <x-jet-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                                    </div>

                                    <div class="col-md-6">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password*') }}" />
                                        <x-jet-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                    </section> 
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div>
                                            <x-jet-label for="terms">
                                                <div class="flex items-center">
                                                    <x-jet-checkbox name="terms" id="terms"/>

                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-jet-label>
                                        </div>
                                    @endif

                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>
                                        <div class="reg-action-block">
                                            <button type='submit' id='ajaxregisterbtn' class="btn btn-primary mt-4 w-100">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div id='registererrors'></div>
                                    <div id='ajaxregisterresults'></div>
                                </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection