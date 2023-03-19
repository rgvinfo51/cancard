@extends('frontend.mainmaster')
@section('title')
@if($applicationdetail->metatitle!='')
    {{ $applicationdetail->metatitle }}
    @else
    {{ $applicationdetail->applicationname }}
    @endif
@stop

@section('metakeywords')
@if($applicationdetail->metakeywords!='')
    {{ $applicationdetail->metakeywords }}
    @endif
@stop

@section('description')
@if($applicationdetail->metadescription!='')
    {{ $applicationdetail->metadescription }}
@endif
@stop
@section('content')
<?php  $exists = Storage::disk('public')->exists('/uploads/applicationbanner/'.$applicationdetail->banner);
$backgroundurl='';
        if($exists && $applicationdetail->banner!=NULL){
            $backgroundurl= 'background-image:url(\''.asset('storage/uploads/applicationbanner/'.$applicationdetail->banner).'\')';
        }
        $categorylistinghtml='';
 if(!$appcategories->isEmpty()){
             
       $categorylistinghtml=' <section class="ps-section--blog container-fluid container">
                <h3 class="ps-section__title display-1" style="font-size: 35px;">Products category </h3>
                <div class="ps-section--category related-industries-category">';
                    foreach($appcategories as $appcategory){
                            $categorylistinghtml.='<div class="ps-section__item">
                        <div class="ps-category__thumbnail"> 
                            <a class="ps-category__image" href="'.route('categorydetail',$appcategory->slug).'">';
                                 $exists = Storage::disk('public')->exists('/uploads/category/'.$appcategory->categoryimage);
                                 if($appcategory->categoryimagealttext!='')
                                $imgtitle=$appcategory->categoryimagealttext;
                                else
                                $imgtitle=$appcategory->name;
                                    if($exists && $appcategory->categoryimage!=NULL){
                                        $categorylistinghtml.='<img class="" src="'.asset('storage/uploads/category/'.$appcategory->categoryimage).'" alt="'.$imgtitle.'"/>';
                                    }
                                    else{ $categorylistinghtml.='<img class="" src="'.$appcategory->name.'"/>';}
                                    
                            $categorylistinghtml.='</a>
                            <div class="ps-category__content">
                                <a class="ps-category__name" href="'.route('categorydetail',$appcategory->slug).'">'.$appcategory->name.'</a>
                                <p>'.$appcategory->shortdescription.'</p>
                                <a class="ps-category__more" href="'.route('categorydetail',$appcategory->slug).'">View More</a>
                            </div>
                        </div>
                    </div>';
                    }
                    
                $categorylistinghtml.='</div>
            </section>';
             }                                   
?>                            
<div class="myhealthcarepage">
<section class="myhealthcare">
    <div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                            <?php 
                            if($applicationdetail->banneralttext!='')
                            $imgtitle=$applicationdetail->banneralttext;
                            else if($applicationdetail->metatitle!='')
                            $imgtitle=$applicationdetail->metatitle;
                            else
                            $imgtitle=$applicationdetail->applicationinfo;
                            ?>
                                <img class="" src="{{ URL::asset('storage/uploads/applicationbanner/'.$applicationdetail->banner) }}" alt="{{$imgtitle}}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">{{$applicationdetail->applicationinfo}}</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
<div class="ps-about--info container-fluid">{!! str_replace('[applicationcategories]', $categorylistinghtml, $applicationdetail->description) !!}</div>
{!! $categorylistinghtml !!}
    </div>
<section class="applicationcontactussection">
    <div class="container">
    <div class="row">
<h2>Talk to our team today about your custom industrial solution.</h2>
<a class="btncallto" href="/contact-us">Contact Us</a>
</div>
    </div>
</section>
</section>
</div>
@endsection