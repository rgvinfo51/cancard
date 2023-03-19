<div class="row m-0">
    @if($products -> isEmpty())
    <div class="col-12 col-lg-12"><h3 class="text-center text-danger">Product Not Found </h3></div>

    @else

                @php
                $i=1;
                @endphp
                @foreach($products as $item)
                <div class="col-12 col-lg-6">
                    <div class="ps-product ps-product--horizontal">
                        <div class="ps-product__thumbnail">
                            <a class="ps-product__image" href="{{route('productdetail',$item->slug)}}">
                                <?php  $exists = Storage::disk('public')->exists('/uploads/product-thumbnail/'.$item->productimage);
                                if($item->productimagealttext!='')
                                    $imgtitle=$item->productimagealttext;
                                    else if($item->metatitle!='')
                                    $imgtitle=$item->metatitle;
                                    else
                                    $imgtitle=$item->productname;
                                ?>
                                    @if($exists && $item->productimage!=NULL)
                                        <img class="" src="{{ asset('storage/uploads/product-thumbnail/'.$item->productimage) }}" alt="{{$imgtitle}}"/>
                                    @else
                                         <img class="" src="{{ asset('storage/uploads/product/'.$item->productimage) }}" alt="{{$imgtitle}}"/>
                                    @endif
                            </a>
                        </div>
                        <div class="ps-product__content">
                            <h5 class="ps-product__title"><a href="{{route('productdetail',$item->slug)}}">{{$item->productname}}</a></h5>
                            @if($item->hideprice==0)
                            <div class="ps-product__meta">
                                <span class="ps-product__price" translate="no">${{$item->price}}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @php
                $i++;
                if($i>=5){break;}
                @endphp
                    @endforeach
    @endif
    
</div>
<div class="ps-result__viewall"><a href="#" onclick="document.getElementById('searchform').submit();">View all results</a></div>