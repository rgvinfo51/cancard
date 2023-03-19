@extends('frontend.mainmaster')
@section('content')
<div class="breadcrumb-block breadcrumb-full">
    <ul class="ps-breadcrumb">
        <li class="ps-breadcrumb__item"><a href="{{url('')}}">Home</a></li>
        <li class="ps-breadcrumb__item active" aria-current="page">Search</li>
    </ul>
</div>
<div class="ps-home ps-home--8">
    <!--<div class="ps-home__content">
        <div class="container-fluid">
            <section class="ps-section--banner ps-banner--container row"> 
                <div class="col-md-12 col-sm-12 pdr-0">
                    <div class="static-banner-block">
                             <div class="static-banner-img">
                                <img class="" src=""/>
                                </div>
                        <div class="ps-banner static-banner-content">
                            <h2 class="ps-banner__title text-white">Search</h2>
                            <p><b>Total Search </b><span class="badge badge-danger" style="background: #FF0000;"> {{ count($products) }} </span> Items  </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>-->

    <section class="ps-section--blog container-fluid product-catogory-block prd-bg-white searcharea">
        <div class="container">
            <div class="search-results-block">
                <h3 class="ps-section__title display-1">Search Results</h3>
                <div class="product-category-listing">
                    @foreach($products as $product)
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
                                    
                                    <div class="ps-banner btn-block">
                                        <a href="{{route('productdetail',$product->slug)}}" class="bg-warning ps-banner__shop">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! $products->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection