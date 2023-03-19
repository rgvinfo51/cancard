@extends('frontend.mainmaster')
@section('title')
@if($newsdetail->metatitle!='')
    {{ $newsdetail->metatitle }}
    @else
    {{ $newsdetail->title }}
    @endif
@stop

@section('metakeywords')
@if($newsdetail->metakeywords!='')
    {{ $newsdetail->metakeywords }}
    @endif
@stop

@section('description')
@if($newsdetail->metadescription!='')
    {{ $newsdetail->metadescription }}
@endif
@stop
@section('content')
<div class="maininnerpage">
<div class="inner-title-background newsdetail-background">
    <h1 class="service-heading">
        News Detail
    </h1>
</div></div>
<div class="container newsarea">
<section class="newsevents-block">
        <div class="container">
            <div class="ne-list-block">
                <div class="ne-details-item-block">
                    <?php  $exists = Storage::disk('public')->exists('/uploads/news/'.$newsdetail->bannerimage);?>
                     <?php
                        if($newsdetail->bannerimagealttext!='')
                         $imgtitle=$newsdetail->bannerimagealttext;
                        else
                        $imgtitle=$newsdetail->title;
                         ?>
                    @if($exists && $newsdetail->bannerimage!=NULL)
                        <div class="ne-item-img-block">
                            <img src="{{ asset('storage/uploads/news/'.$newsdetail->bannerimage) }}"  alt="{{$imgtitle}}"/>
                        </div>
                    @endif
                    
                    <div class="ne-item-content-block">
                    <span class="newsdate">{{ date('F d, Y', strtotime($newsdetail->created_at)) }}</span>
                        <h3 class="newsinner-title">{{ $newsdetail->title }}</h3>
                        {!! $newsdetail->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    </div>
        @endsection