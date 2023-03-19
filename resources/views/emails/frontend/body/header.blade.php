<style>
    .dropdown:hover .dropdown-menu {
        transition: all 1s ease-in-out;
        display: block;
        margin-top: 0;
    }
</style>

<header class="ps-header ps-header--2 ps-header--8"> 
    <div class="header-sticky">
        <div class="container">
            <div class="ps-header__middle">
                <div class="head-container">

                    <div class="ps-logo w-25"><a href="{{ url('/') }}"> <img class="w-100" src="{{ URL::asset('frontend/img/cancard-logo.png') }}" alt><img class="sticky-logo w-100" src="{{ URL::asset('frontend/img/cancard-logo.png') }}" alt></a></div><a class="ps-menu--sticky" href="#"><i class="fa fa-bars"></i></a>
                    <div class="ps-header__right w-100">
                        <ul class="ps-header__icons">
                            <li class="languages">
                                <a href="#" onclick="doGTranslate('en|en');return false;" title="English" class=" nturl notranslate" style="background-position:-0px -0px;">EN</a> | 
                                <a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class=" nturl notranslate" style="background-position:-100px -400px;">FR</a>
                                <div id="google_translate_element2"></div>
                            </li>
                            @auth
                            
                            
                            <li><a class="ps-header__item open-search" href="#"><i class="icon-magnifier"></i></a></li>
                            
                            <li><a class="ps-header__item" href="#" id="cart-mini"><i class="icon-cart-empty"></i><span class="badge" id="cartitemcount">0</span></a>
                                <div class="ps-cart--mini">
                                    <div class="" id="minicartresults">

                                        <ul class="ps-cart__items">
                                           @foreach($cartitems as $cartitem)

                                           <li class="ps-cart__item">
                                            <div class="ps-product--mini-cart">
                                                <a class="ps-product__thumbnail" href="#">
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$cartitem->productimage);?>
                                                    @if($exists && $cartitem->productimage!=NULL)
                                                    <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product-thumbnail/'.$cartitem->productimage) }}"/>
                                                    @else
                                                    <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product/'.$cartitem->productimage) }}"/>
                                                    @endif
                                                </a>
                                                <div class="ps-product__content"><a class="ps-product__name" href="#">{{$cartitem->productname}}</a>
                                                    <p class="ps-product__meta"> <span class="ps-product__price">${{$cartitem->price}}</span></p>
                                                </div><a class="ps-product__remove" href="javascript: void(0)"><i class="icon-cross"></i></a>
                                            </div>
                                        </li>

                                        @endforeach
                                    </ul>
                                    
                                    
                                    
                                </div>
                            </div>
                        </li>
                        <li>
                                <!-- <a class="ps-header__item" href="{{ url('/dashboard') }}" id="login-modal">
                                    @if(!empty(Auth::user()->name))
                                    <i class="icon-user"></i>
                                    @endif
                                </a> --> 
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->name }} </a>
                                    <div class="dropdown-menu" style="position: absolute; transform: translate3d(0px, 23px, 0px); top: 0px; left: 0px; will-change: transform;font-size: 15px;color:#5f74a1;box-shadow:  0 1rem 3rem rgba(0,0,0,0.275);border: 1px solid rgb(118 118 118 / 52%);border-radius: 8px 10px;">
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('profile')}}"> <i class="fas fa-user"></i> My Profile</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('addresses')}}"> <i class="fas fa-map-marker-alt"></i> Addresses</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('orders')}}"> <i class="fas fa-sticky-note"></i> Orders</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('myquotes')}}"> <i class="fas fa-quote-right"></i> Quotes</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('paymentsetting')}}"> <i class="fas fa-money"></i> Payment Settings</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('security')}}"> <i class="fas fa-shield-alt"></i> Security</a>
                                        <a class="dropdown-item" style="color:#425f9d !important;margin: 8px 0px;" href="{{route('user.logout')}}"> <i class="fas fa-sign-out-alt"></i> Sign Out</a>
                                    </div>
                                </div>
                            </li>
                            @endauth
                            @guest
                            <li><a class="ps-header__item" href="{{ url('/login') }}" id="login-modal"><i class="icon-user"></i></a></li>
                            @endguest
                        </ul>
                        <div class="ps-header__search">
                            <form method="post" action="{{ route('product.search') }}" id="searchform">
                                @csrf
                                <div class="ps-search-table">
                                    <div class="input-group">
                                        <input class="form-control ps-input col-12" type="text" placeholder="Search for products" name="search" id="searchinput" value="{!! !empty($searchterm) ? $searchterm : '' !!}" size="77">
                                        <div class="input-group-append"><button type="submit"><i class="fa fa-search"></i></div>
                                        </div>
                                    </div>
                                </form>
                                <div class="ps-search--result">
                                    <div class="ps-result__content">

                                    </div>
                                </div>
                            </div>
                            <div class="ps-middle__text">Need help? <strong><a href="tel:+18559491110">855-949-1110</a></strong></div>
                        </div>
                    </div>
                </div> </div>
                <div class="container">
                    <div class="wsmainwp clearfix">
                        <!--Main Menu HTML Code-->
                        <nav class="wsmenu clearfix">
                          <ul class="wsmenu-list">
                            <li aria-haspopup="true" class=""><a href="{{ url('/') }}" class="{{ (Request::is('/') ? 'menuactive' : '') }}">Home</a></li>
                            <li aria-haspopup="true"><a href="#" onclick="myFunction()" class="{{Request::routeIs('categorydetail')? 'menuactive':''}}">Products <span class="wsarrow"></span></a>
                                <ul class="sub-menu"id="myDIV">
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($headercategories as $category)
                                    @php
                                    $hassubcat=0; 
                                    @endphp
                                    @if($category->parentid==null)
                                    <li aria-haspopup="true" >
                                        <a href="{{route('categorydetail',$category->slug)}}"onclick="mySubFunction()">{{ ucwords(strtolower($category->name)) }}</a>
                                        @foreach($headersubcategories as $subcategory)
                                        @if($subcategory->parentid==$category->id)
                                        @php
                                        $hassubcat=1;
                                        @endphp
                                        @break
                                        @endif
                                        @endforeach
                                        @if($hassubcat)
                                        <ul class="sub-menu"id="mySubDiv">
                                            @foreach($headersubcategories as $subcategory)
                                            @if($subcategory->parentid==$category->id)
                                            <li><a href="{{route('categorydetail',$subcategory->slug)}}">{{ ucwords(strtolower($subcategory->name)) }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @foreach($headerindustries as $headerindustry)
                            <li aria-haspopup="true"><a href="{{route('applicationdetail',$headerindustry->slug)}}" onclick="myFunction()" class="{{ (Request::segment(1) === 'application' && Request::segment(2) === $headerindustry->slug) ? 'menuactive' : null }}"">{{$headerindustry->applicationname}} <span class="wsarrow"></span></a>
                                <ul class="sub-menu"id="myDIV">
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach($headercategories as $category)
                                    @php $hassubcat=0; @endphp
                                    @if($category->applications!='')
                                    @php
                                    $relatedapplication=explode(",",$category->applications);
                                    if (in_array($headerindustry->id, $relatedapplication)){
                                    $hassubcat=1;
                                }
                                @endphp
                                @if($hassubcat)
                                <li aria-haspopup="true" >
                                    <a href="{{route('categorydetail',$category->slug)}}"onclick="mySubFunction()">{{ ucwords(strtolower($category->name)) }}</a>
                                </li>
                                @endif
                                @endif


                                @endforeach
                            </ul>
                        </li>
                        @endforeach

                        <li aria-haspopup="true"><a href="{{route('servicesupport')}}" class="{{Request::routeIs('servicesupport')? 'menuactive':''}}">Service & Support</a></li>
                        <li aria-haspopup="true"><a href="{{route('store')}}" class="{{Request::routeIs('store')? 'menuactive':''}}">E-Store</a></li>
                        <!--<li aria-haspopup="true"><a href="{{route('aboutus')}}">About Us</a></li>--> 
                        <li aria-haspopup="true"><a href="{{route('contactus')}}" class="{{Request::routeIs('contactus')? 'menuactive':''}}">Contact Us</a></li> 
                        <li aria-haspopup="true"><a href="{{route('requestquotelist')}}" class="{{Request::routeIs('requestquotelist')? 'menuactive':''}}">My Quote<span id="myquotecount"></span></a></li> 
                    </ul>
                </nav>
                <div class="pt-3">
                    <!-- @auth
                    <a data-toggle="modal" data-target="#uploadPOModal" class="btn_ btn-primary_" style="margin: 0px !important;color: white;background-color: #2f5cbe;padding: 5px 10px;border-radius: 5px;margin-right: 7px !important;cursor: pointer;">Upload PO</a>
                    @endauth -->
                    Need help? <strong><a href="tel:+18559491110">855-949-1110</a></strong>
                </div>
                <!--Menu HTML Code-->
            </div></div></div>

        </header>
        

        <header class="ps-header ps-header--8 ps-header--mobile">
            <!--<div class="ps-noti">
                <div class="container">
                    <p class="m-0">Due to the <strong>COVID 19 </strong>epidemic, orders may be processed with a slight delay</p>
                </div><a class="ps-noti__close"><i class="icon-cross"></i></a>
            </div>-->
            <div class="ps-header__middle">
                <div class="container">

                    <div class="ps-logo"><a href="{{ url('/') }}"> <img src="{{ URL::asset('frontend/img/mobile-logo.png') }}" alt></a></div>
                    <div class="ps-header__right w-100">
                        <ul class="ps-header__icons mr-5">
                            <li><a class="ps-header__item open-search" href="#"><i class="fa fa-search"></i></a></li>
                        </ul>
                        <div class="wsmobileheader clearfix ">
                            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                        </div>
                        <nav class="navbar navbar-default headermobilemenu">
                            <div class="container">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                      <span class="sr-only">Toggle navigation</span>
                                      <svg viewBox="0 0 100 80" width="40" height="40">
                                        <rect width="100" height="20"></rect>
                                        <rect y="30" width="100" height="20"></rect>
                                        <rect y="60" width="100" height="20"></rect>
                                    </svg>
                                </button>

                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="has-mega-menu"><a href="{{ url('/') }}">Home</a></li>

                                    <li class="dropdown">
                                        <a href="{{url('/products')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <div class="container">
                                                <div class="row">
                                                    @foreach($headercategories as $category)
                                                    @if($category->parentid==null)
                                                    <div class="col-xs-6 col-md-3">
                                                        <ul class="nav flex-column">
                                                            <li class="nav-item">
                                                                <a href="{{route('categorydetail',$category->slug)}}"><span class="nav-link text-bold">{{$category->name}}</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                            <!--  /.container  -->


                                        </div>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Industries <span class="caret"></span></a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-3">
                                                        <ul class="nav flex-column">
                                                            @foreach($headerindustries as $headerindustry)
                                                            <li><a href="{{route('applicationdetail',$headerindustry->slug)}}">{{$headerindustry->applicationname}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  /.container  -->

                                        </div>
                                    </li>
                                    <li class=""><a href="{{route('servicesupport')}}">Service & Support</a></li>
                                    <li class=""><a href="{{route('store')}}">E-Store</a></li>
                                    <li class=""><a href="{{route('aboutus')}}">About</a></li>
                                    <li class=""><a href="{{route('contactus')}}">Contact</a></li> 
                                    <li class=""><a href="{{route('requestquotelist')}}">My Quote<span id="myquotecount"></span></a></li> 
                                </ul>


                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- The Modal -->
    <!-- <div class="modal fade mt-5 pt-5" id="uploadPOModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-body mt-3 py-5 pl-5">
                    <div class="my-4">
                        <p class="modal-title" style="color: #2f5cbe !important;">Upload Purchase Order</p>
                        <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 58px;top: 51px;">Close</button>
                    </div>
                    <form action="{{ route('uploadpo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label style="color: #2f5cbe !important;">Upload PO</label>
                        <div class="row">
                            <div class="col-7 ">
                                <input type="file" name="po_file" id="po_file">
                            </div>

                            <div class="col-1"></div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                    </div>

                    <div class="row pb-5">
                        <div class="col-7">
                            <p class="text-muted">Upload pdf/ jpg/ png format only</p>
                        </div>

                        <div class="col-1"></div>

                        <div class="col-4">
                            <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>

            </div>

            
        </div>
    </div>
</div> -->
    <script>
        function myFunction() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    function mySubFunction() {
      var m = document.getElementById("mySubDIV");
      if (m.style.display === "none") {
        m.style.display = "block";
    } else {
        m.style.display = "none";
    }
}
</script>