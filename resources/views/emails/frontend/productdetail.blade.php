@extends('frontend.mainmaster')
@section('title')
@if($productdetails->metatitle!='')
    {{ $productdetails->metatitle }}
    @else
    {{ $productdetails->productname }}
    @endif
@stop

@section('metakeywords')
@if($productdetails->metakeywords!='')
    {{ $productdetails->metakeywords }}
    @endif
@stop

@section('sourcelink')
@if($productdetails->sourcelink!='')
    {{ $productdetails->sourcelink }}
    @endif
@stop

@section('description')
@if($productdetails->metadescription!='')
    {{ $productdetails->metadescription }}
@endif
@stop

@section('sharingmetatag')
@if($productdetails->metatitle!='')
    <meta property="og:title" content="{{ $productdetails->metatitle }}"/>
@else
<meta property="og:title" content="{{ $productdetails->productname }}"/>
@endif
<?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$productdetails->productimage);?>
@if($exists && $productdetails->productimage!=NULL)
    <meta property="og:image" content="{{ asset('storage/uploads/product-thumbnail/'.$productdetails->productimage) }}"/>
@else
    <meta property="og:image" content="{{ asset('storage/uploads/product/'.$productdetails->productimage) }}"/>
@endif
<meta property="og:url" content="{{route('productdetail',$productdetails->slug)}}"/>
<meta property="og:description" content="{{ $productdetails->metadescription }}"/>
@stop
@section('content')
   <div class="container">
<div class="myprocancard mainheader">  
  <div class="ps-page--product ps-page--product1">
            <div class="container mt-5">
                
                <div class="ps-page__content">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="ps-product--detail">
                                <div class="row">
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-product--gallery">
                                            <div class="ps-product__thumbnail">
                                                <?php 
                                                if($productdetails->productimagealttext!='')
                                                    $imgtitle=$productdetails->productimagealttext;
                                                    else if($productdetails->metatitle!='')
                                                    $imgtitle=$productdetails->metatitle;
                                                    else
                                                    $imgtitle=$productdetails->productname;
                                                    ?>
                                                @if($productgallery->isEmpty())
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$productdetails->productimage); ?>
                                                    
                                                    @if($exists && $productdetails->productimage!=NULL)
                                                       <div class="slide">
                                                          <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product/'.$productdetails->productimage) }}" alt="{{$imgtitle}}"/>
                                                        </div>

                                                    @else
                                                        <img class="card-img-top" src="{{asset('frontend/img/public')}}/images/defaultproduct.jpg">
                                                    @endif
                                                @endif
                                                @foreach($productgallery as $productimg)
                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$productimg->imagename);?>
                                                        @if($exists && $productimg->imagename!=NULL)
                                                        <div class="slide">
                                                        <div class="ps-gallery__item">
                                                            <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product/'.$productimg->imagename) }}"/>
                                                         </div>
                                                        </div>
                                                        @endif
                                                      @endforeach
                                            </div>
                                            <div class="ps-gallery--image">
                                                @if($productgallery->isEmpty())
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$productdetails->productimage);?>
                                                    @if($exists && $productdetails->productimage!=NULL)
                                                       <div class="slide">
                                                          <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product/'.$productdetails->productimage) }}" alt="{{$imgtitle}}"/>
                                                        </div>

                                                    @else
                                                        <img class="card-img-top" src="{{asset('frontend/img/public')}}/images/defaultproduct.jpg">
                                                    @endif
                                                @endif
                                                    @foreach($productgallery as $productimg)
                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/'.$productimg->imagename);?>
                                                        @if($exists && $productimg->imagename!=NULL)
                                                        <div class="slide">
                                                        <div class="ps-gallery__item">
                                                            <img class="img-fluid z-depth-1" src="{{ asset('storage/uploads/product/'.$productimg->imagename) }}"/>
                                                         </div>
                                                        </div>
                                                        @endif
                                                      @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6">
                                        <div class="ps-product__info">
                                            <div class="ps-product__title"><h1>{{ $productdetails->productname }}</h1></div>

                                            <div class="show_rating" style="font-size: 24px !important;">
                                                @if(empty($product_rating))
                                                    <i class="fa fa-star-o text-secondary"></i>
                                                    <i class="fa fa-star-o text-secondary"></i>
                                                    <i class="fa fa-star-o text-secondary"></i>
                                                    <i class="fa fa-star-o text-secondary"></i>
                                                    <i class="fa fa-star-o text-secondary"></i>
                                                @else
                                                    @for($i=1;$i <=5;$i++)
                                                        @if(round($product_rating - .25) >= $i)
                                                            <i class="fa fa-star text-warning"></i>
                                                        @elseif(round($product_rating + .25) >= $i)
                                                            <i class="fa fa-star-half-o text-warning"></i>
                                                        @else
                                                            <i class="fa fa-star-o text-secondary"></i>
                                                        @endif    
                                                    @endfor
                                                @endif
                                                
                                            </div>

                                            <div class="ps-product__desc">
                                                {!! $productdetails->shortdescription !!}
                                            </div>
                                            <div class="ps-product__meta" >
                                                @if(!$productoptions->isEmpty())
                                                    @php
                                                        $productdetails->price=$productoptions[0]->price;
                                                        $productdetails->discountprice=$productoptions[0]->discountprice;
                                                    @endphp
                                                @endif
                                                @auth
                                                    
                                                    @if(!$productdetails->hideprice)
                                                        @if($productdetails->discountprice!='')
                                                        <span class="ps-product__price sale" id="productdiscountprice" translate="no">${{$productdetails->discountprice}}</span><span class="ps-product__del" id="productprice" translate="no">${{$productdetails->price}}</span>
                                                        @else
                                                        <span class="ps-product__price sale" id="productprice" translate="no">${{$productdetails->price}}</span></span>
                                                        @endif
                                                    @else
                                                    <div class="hidepricenotice">Please contact us for price</div>
                                                    @endif
                                                @endauth
                                                @guest
                                                Login <a class="seepricenotice" href="{{route('login')}}">here</a> to check price & buy
                                                @endguest
                                            </div>
                                            <div class="ps-product__variations">
                                                <form method="post" id="productaddtocart">
                                                   @csrf
                                                <input type="hidden" name="pid" id="pid" value="{{ $productdetails->id }}">
                                                    @if(!$productoptions->isEmpty())
                                                    <select required="" name="optionid" id="productoptionid" onchange="productoptionprice()">
                                                            @foreach($productoptions as $productoption)
                                                                @php
                                                                    $isselected = '';
                                                                @endphp
                                                                <option value="{{$productoption->id}}" data-price="{{$productoption->price}}" data-discountprice="{{$productoption->discountprice}}">{{$productoption->optionname}}</option>

                                                            @endforeach
                                                    </select>  <br><br>
                                                    @endif

                                                    <div class="inpbx"><label>Qty</label>
                                                    <input class="quantity" type="number" name="qty" id="qty" value="1" min="1">
                                                    </div>
                                                    
                                                <div class="detailactionbtn">
                                                    @auth
                                                        @if(!$productdetails->hideprice)
                                                            <a class="btn btn-primary" href="javascript:void(0)" onclick="addToCart()">Add to Cart</a>
                                                        @endif
                                                     @endauth
                                                    <a class="btn btn-secondary" href="javascript:void(0)" onclick="addToQuote()">Get A Quote</a>
                                                </div>
                                                    @if($productdetails->englishbrochure!='' || $productdetails->frenchbrochure!='')
                                                    <div class="download-btn-block">
                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/brochure/en/'.$productdetails->englishbrochure);?>
                                                        @if($exists && $productdetails->englishbrochure!=NULL)
                                                        <a href="{{ asset('storage/uploads/product/brochure/en/'.$productdetails->englishbrochure) }}" target="_blank" class="btn btn-primary"/>English Brochure</a>
                                                        @endif
                                                        <?php  $exists = Storage::disk('public')->exists('/uploads/product/brochure/fr/'.$productdetails->frenchbrochure);?>
                                                        @if($exists && $productdetails->frenchbrochure!=NULL)
                                                            <a href="{{ asset('storage/uploads/product/brochure/fr/'.$productdetails->frenchbrochure) }}" target="_blank" class="btn btn-primary">French Brochure</a>
                                                        @endif
                                                    </div>
                                                    @endif
                                                
                                                </form>
                                            </div>
                                            
                                        </div>
                                        <div class="ps-product__type">
                                                <ul class="ps-product__list">
                                                    @if( $productdetails->applications!=NULL)
                                                    <li> <span class="ps-list__title">Tags: </span>
                                                        
                                                        @foreach($applications as $application)
                                                        @php
                                                            $isselected = '';
                                                        @endphp
                                                            @foreach(explode(',', $productdetails->applications) as $info)
                                                                @if($info == $application->id)
                                                                    <a class="ps-list__text" href="#">{{ $application->applicationname }}</a>

                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </li>
                                                    @endif
                                                    @if( $productdetails->productsku!=NULL)
                                                    <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">{{ $productdetails->productsku }}</a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="ps-product__social">
                                                @php
                                                    $site_url  = route('productdetail',$productdetails->slug);
                                                    $site_title  = "Cancard";
                                                    $sharemetadescription=urlencode($productdetails->metadescription);
                                                @endphp
                                                <ul class="ps-social ps-social--color">
                                                    <!-- Facebook Social Media -->
                                                    <li><a class="ps-social__link facebook" href="http://www.facebook.com/sharer.php?u=<?=$site_url?>" target="_blank"><i class="fa fa-facebook"> </i><span class="ps-tooltip">Facebook</span></a></li>
                                                    <li class="ps-social__linkedin"><a class="ps-social__link linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=$site_url?>" target="_blank"><i class="fa fa-linkedin"></i><span class="ps-tooltip">Linkedin</span></a></li>
                                                    <li><a class="ps-social__link twitter" href="https://twitter.com/share?url=<?=$site_url?>&amp;text=<?=$sharemetadescription?>;hashtags=Cancard"><i class="fa fa-twitter"></i><span class="ps-tooltip">Twitter</span></a></li>
                                                    <li class="ps-social__email"><a class="ps-social__link envelope" href="href="mailto:?Subject=<?=$site_title?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?=$site_url?>""><i class="fa fa-envelope-o"></i><span class="ps-tooltip">Email</span></a></li>
                                                </ul>
                                            </div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <ul class="nav nav-tabs ps-tab-list" id="productContentTabs" role="tablist">
                                        <li class="nav-item" role="presentation"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description-content" role="tab" aria-controls="description-content" aria-selected="true">Description</a></li>

                                        <li class="nav-item" role="presentation"><a class="nav-link" id="review-tab" data-toggle="tab" href="#review-content" role="tab" aria-controls="review-content" aria-selected="true">Rating And Reviews</a></li>
                                    </ul>
                                    <div class="tab-content" id="productContent">
                                        <div class="tab-pane fade show active" id="description-content" role="tabpanel" aria-labelledby="description-tab">
                                            <div class="ps-document">
                                                <div class="row row-reverse">
                                                    {!! $productdetails->longdescription !!}
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="review-content" role="tabpanel" aria-labelledby="review-tab">
                                            <div class="ps-document">
                                                <!-- <div class="row row-reverse"> -->
                                                    @if(!empty($user_reviews) && count($user_reviews) > 0)
                                                    @foreach($user_reviews as $review)
                                                    <div class="border-bottom mb-4">
                                                      <div><b>{{ucwords($review->name.$review->lname)}}</b></div>
                                                      @for($i=1;$i<=5;$i++)
                                                          @if($review->start_rating >=$i)
                                                          <i class="fa fa-star text-warning" style="font-size: 20px;"></i>
                                                          @else
                                                          <i class="fa fa-star-o text-secondary" style="font-size: 20px;"></i>
                                                          @endif  
                                                      @endfor
                                                      <div class="text-muted">{{ $review->comments}}</div>
                                                      <div class="text-right">On {{date("l jS F Y h:i:s A",strtotime($review->created_at))}}</div>
                                                    </div>
                                                    
                                                    @endforeach
                                                    @endif
                                                    
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                    $rplists=explode(',', $productdetails->rplist);

            @endphp
            @if($productdetails->rplist!='')
            <section class="ps-section--also relatedproductsection" data-background="img/related-bg.jpg">
                <div class="container">
                    <h3 class="ps-section__title">Related Products</h3>
                    <div class="ps-section__carousel product-details-related-block">
                        <div class="owl-carousel" data-owl-auto="false" data-owl-loop="false" data-owl-speed="13000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="4" data-owl-duration="1000" data-owl-mousedrag="on">
                                    
                            @foreach($relatedproducts as $relatedproduct)
                                <div class="ps-section__item">
                                        <div class="ps-blog--latset">
                                                <div class="ps-blog__thumbnail">
                                                        <a href="{{ route('productdetail',$relatedproduct->slug) }}">
                                                         <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$relatedproduct->productimage);?>
                                                            <?php 
                                                            if($relatedproduct->productimagealttext!='')
                                                                $imgtitle=$relatedproduct->productimagealttext;
                                                                else if($relatedproduct->metatitle!='')
                                                                $imgtitle=$relatedproduct->metatitle;
                                                                else
                                                                $imgtitle=$relatedproduct->productname;
                                                                ?>
                                                        @if($exists && $relatedproduct->productimage!=NULL)
                                                            <img class="" src="{{ asset('storage/uploads/product-thumbnail/'.$relatedproduct->productimage) }}" alt="{{$imgtitle}}"/>
                                                        @else
                                                             <img class="" src="{{ asset('storage/uploads/product/'.$relatedproduct->productimage) }}" alt="{{$imgtitle}}"/>
                                                        @endif
                                                        </a>
                                                </div>
                                                <div class="ps-blog__content related-prd-content">
                                                        <h3>{{$relatedproduct->productname}}</h3>

                                                </div>
                                        </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            </section>
            @endif
  </div>
  </div></div>
  @endsection