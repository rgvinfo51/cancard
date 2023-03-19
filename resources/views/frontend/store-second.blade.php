@extends('frontend.mainmaster')
@section('content')

<div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                                <img class="" src="{{ URL::asset('frontend/img/slide1.jpg') }}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">Demo E-Store</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
    <section class="ps-section--blog container-fluid product-catogory-block prd-bg-white estorelisting">
        <div class="container">
        <div class="row estoresearchrow">
             <div class="col-12 col-md-8"></div>
             <div class="col-12 col-md-4">
                 <div class="searchbox">
                 <form method="post" action="{{ route('storesearch') }}" id="searchform">
                            @csrf
                                <div class="ps-search-table">
                                    <div class="input-group">
                                        <input class="form-control ps-input" type="text" placeholder="Search for products" name="search" id="searchinput" value="{!! !empty($searchterm) ? $searchterm : '' !!}">
                                        <div class="input-group-append"><button type="submit"><i class="fa fa-search"></i></button></div>
                                    </div>
                                </div>
                            </form>
                 </div>
             </div>
            
        </div>
        <div class="row">
           
            <div class="col-12 col-md-3 catesub">
            <div class="ps-widget ps-widget--product">
                <div class="ps-widget__block">
                    <h4 class="ps-widget__title">Industry</h4>
                <ul class="filter industry">
                    @foreach($headerindustries as $headerindustry)
                            <li class="{{ $headerindustry->id==$activeindustryid ? 'active industry' : '' }}"><a href="{{route('storeindustry',$headerindustry->slug)}}">{{$headerindustry->applicationname}}</a></li>
                    @endforeach
                </ul>
                </div>
                <div class="ps-widget__block">
                    <h4 class="ps-widget__title">Products</h4>
                    <section class="nav-wrap">
                        <nav class="acnav" role="navigation">
                                <!-- start level 1 -->
                                <ul class="acnav__list acnav__list--level1">

                                        <!-- start group 1 -->

                                        @foreach($headercategories as $category)
                                            @php
                                        $activeclass="has-no-children";
                                        @endphp
                                            @if($category->parentid==null)
                                                @foreach($headersubcategories as $subcategory)
                                                        @if($subcategory->parentid==$category->id)
                                                        @php
                                                        $activeclass="has-children";
                                                        @endphp
                                                        @break
                                                        @endif
                                                @endforeach
                                            <li class="{{$activeclass}} {{ $category->id==$activemaincategoryid ? 'is-open' : '' }}">
                                                <div class="acnav__label maincategory">
                                                        <a href="{{route('storecategory',$category->slug)}}">{{ ucwords(strtolower($category->name)) }}</a>
                                                </div>

                                                    <ul class="acnav__list acnav__list--level2" {{ $category->id==$activemaincategoryid ? 'style="display: block;"' : '' }}>
                                                    @foreach($headersubcategories as $subcategory)
                                                        @if($subcategory->parentid==$category->id)
                                                            <li class="{{ $subcategory->id==$activesubcategoryid ? 'subcategory current' : '' }}"><a class="acnav__link acnav__link--level2" href="{{route('storecategory',$subcategory->slug)}}">{{ ucwords(strtolower($subcategory->name)) }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    </ul>
                                            </li>   
                                            @endif
                                        @endforeach

                                </ul>
                        </nav>
                    </section>
                </div>
                
                
                
            </div>
                </div>
            <div class="col-12 col-md-9 catepro">
                <!-- horizontal ilters start -->
                <div class="row ">
                <div class="ps-widget__block col-md-4 ps-widget">
                    <h4 class="ps-widget__title">Brands</h4>
                    <section class="nav-wrap">
                        <nav class="acnav" role="navigation">
                                <!-- start level 1 -->
                                <ul class="acnav__list acnav__list--level1 py-0">

                                        <!-- start group 1 -->                                                     <li class="has-children ">
                                                <div class="acnav__label maincategory">
                                                        <a>Select Brand</a>
                                                </div>
                    <ul class="acnav__list acnav__list--level2">
                                                                                                                <li class=""><a class="acnav__link acnav__link--level2"             href="#">Speedi-Print®</a></li>
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">Precision®</a></li> 
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">Soft-Lock®</a></li>                                                   
                                </ul>
                        </nav>
                    </section>
                </div>

 <div class="ps-widget__block col-md-4 ps-widget">
                    <h4 class="ps-widget__title">Colors</h4>
                    <section class="nav-wrap">
                        <nav class="acnav" role="navigation">
                                <!-- start level 1 -->
                                <ul class="acnav__list acnav__list--level1 py-0">

                                        <!-- start group 1 -->                                                     <li class="has-children ">
                                                <div class="acnav__label maincategory">
                                                        <a>Select Color</a>
                                                </div>
                    <ul class="acnav__list acnav__list--level2">
                                                                                                                <li class=""><a class="acnav__link acnav__link--level2"             href="#">Red</a></li>
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">Purple</a></li>
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">Black</a></li>                                                   
                                </ul>
                        </nav>
                    </section>
                </div>

                <div class="ps-widget__block col-md-4 ps-widget">
                    <h4 class="ps-widget__title">Short by Category</h4>
                    <section class="nav-wrap">
                        <nav class="acnav" role="navigation">
                                <!-- start level 1 -->
                                <ul class="acnav__list acnav__list--level1 py-0">

                                        <!-- start group 1 -->                                                     <li class="has-children ">
                                                <div class="acnav__label maincategory">
                                                        <a>All Types</a>
                                                </div>
                    <ul class="acnav__list acnav__list--level2">
                                                                                                                <li class=""><a class="acnav__link acnav__link--level2"             href="#">Most Populer</a></li>
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">Low Prize</a></li> 
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">High Prize</a></li>
                                                                                                                     <li class=""><a class="acnav__link acnav__link--level2" href="#">New Arrivals</a></li>                                                   
                                </ul>
                        </nav>
                    </section>
                </div>

                </div>
            
                <!-- Horizontal ilters end -->
            <div class="product-category-listing">
                 @foreach($productlist as $product)
                    <div class="ps-section__item">
                        <div class="ps-blog--latset">
                            <div class="ps-blog__thumbnail">
                                <a href="{{route('productdetail',$product->slug)}}">
                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$product->productimage);
                                    if($product->productimagealttext!='')
                                    $imgtitle=$product->productimagealttext;
                                    else if($product->metatitle!='')
                                    $imgtitle=$product->metatitle;
                                    else
                                    $imgtitle=$product->productname;
                                    ?>
                                    @if($exists && $product->productimage!=NULL)
                                        <img class="" src="{{ asset('storage/uploads/product-thumbnail/'.$product->productimage) }}" alt="{{$imgtitle}}"/>
                                    @else
                                         <img class="" src="{{ asset('storage/uploads/product/'.$product->productimage) }}" alt="{{$imgtitle}}"/>
                                    @endif
                                    
                                </a>
                            </div>
                            <div class="ps-blog__content related-prd-content">
                                <h3>{{$product->productname}}</h3>
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
                            <div class="ps-banner btn-block">
                                    <a href="{{route('productdetail',$product->slug)}}" class="bg-warning ps-banner__shop">View Product</a>
                                </div>
                        </div>
                    </div>
                  @endforeach
                  {!! $productlist->links('pagination::bootstrap-4') !!}
            </div>
            </div>
            </div>
        </div>
    </section>
    </div>
        @endsection