@extends('frontend.mainmaster')
@section('title')
News & Events
@stop

@section('metakeywords')
@stop

@section('description')
Latest News & Events
@stop
@section('content')
<div class="maininnerpage">
<div class="inner-title-background about-us-background">
    <h1 class="service-heading">
        News & Events
    </h1>
</div></div>
<div class="container newspage newsinnerpage">
    <section class="newsevents-block">
        <div class="container">
            <div class="ne-list-block">
                @foreach($news as $newsdetail)
                    <div class="ne-list-item-block">
                        <?php  $exists = Storage::disk('public')->exists('/uploads/news/'.$newsdetail->bannerimage);?>
                        <?php
                            if($newsdetail->bannerimagealttext!='')
                             $imgtitle=$newsdetail->bannerimagealttext;
                            else
                            $imgtitle=$newsdetail->title;
                        ?>
                        @if($exists && $newsdetail->bannerimage!=NULL)
                            <div class="ne-item-img-block">
                                <img src="{{ asset('storage/uploads/news/'.$newsdetail->bannerimage) }}" alt="{{$imgtitle}}"/>
                            </div>
                        @endif
                        <div class="ne-item-content-block">
                        <span class="newsdate">{{ date('F d, Y', strtotime($newsdetail->created_at)) }}</span>
                            <h3 class="newsinner-title">{{ $newsdetail->title }}</h3>
                            {!! Str::words($newsdetail->description, 80, ' ...') !!}
                           <div class="newsbtn"><a href="{{route('newsdetail',$newsdetail->slug)}}" class="btn btn-primary">Read More</a></div>
                        </div>
                    </div>
                @endforeach
                 {!! $news->links() !!}
            </div>
        </div>
    </section>
</div>
        @endsection