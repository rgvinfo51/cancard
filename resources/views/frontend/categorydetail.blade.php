@extends('frontend.mainmaster')
@section('title')
@if($categorydetail->metatitle!='')
    {{ $categorydetail->metatitle }}
    @else
    {{ $categorydetail->name }}
    @endif
@stop

@section('metakeywords')
@if($categorydetail->metakeywords!='')
    {{ $categorydetail->metakeywords }}
    @endif
@stop

@section('description')
@if($categorydetail->metadescription!='')
    {{ $categorydetail->metadescription }}
@endif
@stop
@section('content')

<div class="ps-home ps-home--8 maininnerpage">
    <div class="ps-home__content">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                            <?php  $exists = Storage::disk('public')->exists('/uploads/categorybanner/'.$categorydetail->banner);
                            if($categorydetail->banneralttext!='')
                            $imgtitle=$categorydetail->banneralttext;
                            else if($categorydetail->metatitle!='')
                            $imgtitle=$categorydetail->metatitle;
                            else
                            $imgtitle=$categorydetail->name;
                            ?>
                            @if($exists && $categorydetail->banner!=NULL)
                                <img class="" src="{{ asset('storage/uploads/categorybanner/'.$categorydetail->banner) }}" alt="{{$imgtitle}}"/>
                            @else
                                <img class="" src="{{ asset('storage/uploads/categorybanner/'.$categorydetail->banner) }}" alt="{{$imgtitle}}"/>
                            @endif
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">{{$categorydetail->name}}</h1>
                            @if($categorydetail->shortdescription!='' || $categorydetail->shortdescription!=NULL)
                            <p>{{$categorydetail->shortdescription}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<div class="container">
    <section class="categorypage ps-about--info container-fluid">
        <div class="container">
            <div class="ps-about__extent categorydescription">
                <div class="row">
                    <div class="col-md-12">
                    <h2 class="ps-banner__title">{{ $categorydetail->name }}</h2>

                    </div>
                    <div class="col-md-12">
                       {!! $categorydetail->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="categoryme ps-section--blog container-fluid product-catogory-block prd-bg-white">
         <div class="container">
         <div class="row">
                    <!-- <div class="col-md-3">
                        <div class="categoryquickcontact">
                            <h5>Feel Free To Contact Us</h5>
                            <form method="post" action="{{route('contactrequest')}}">
                                            @csrf
                                            <div class="contact-input-group">
                                            <input class="contact-input" type="text" name="fullname" placeholder="Your name*" value="{{old('fullname')}}" required>
                                            @error('fullname')
                                                <span class="input-invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="contact-input-group">
                                            <input class="contact-input" type="email" name="email" placeholder="Your email*" value="{{old('email')}}" required>
                                            @error('email')
                                                <span class="input-invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="contact-input-group">
                                            <input class="contact-input" type="tel" name="phoneno" placeholder="Your Phone" value="{{old('phoneno')}}">
                                            @error('phoneno')
                                                <span class="input-invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="contact-input-group">
                                            <textarea class="contact-input textarea"  name="message" placeholder="Your message*" required>{{old('message')}}</textarea>
                                            @error('message')
                                                <span class="input-invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                        
                                            <div class="contact-input-group">
                                            <input class="contact-btn w-100" type="submit" name="" value="Submit">
                                            </div>
                                        </form>
                        </div>
                    </div> -->
       <div class="col-md-12">
            <div class="product-category-listing ">
                 @foreach($subcategorylist as $subcategory)
                    <div class="ps-section__item">
                        <div class="ps-blog--latset">
                            <div class="ps-blog__thumbnail">
                                <a href="{{route('categorydetail',$subcategory->slug)}}">
                                     <?php  $exists = Storage::disk('public')->exists('/uploads/category/'.$subcategory->categoryimage);
                                        if($subcategory->categoryimagealttext!='')
                                        $imgtitle=$subcategory->categoryimagealttext;
                                        else if($subcategory->metatitle!='')
                                        $imgtitle=$subcategory->metatitle;
                                        else
                                        $imgtitle=$subcategory->name;
                                        ?>
                                    @if($exists && $subcategory->categoryimage!=NULL)
                                        <img class="" src="{{ asset('storage/uploads/category/'.$subcategory->categoryimage) }}" alt="{{$imgtitle}}"/>
                                    @else
                                     <img class="" src="{{ asset('storage/uploads/category/'.$subcategory->categoryimage) }}" alt="{{$imgtitle}}"/>
                                    @endif
                                    
                                </a>
                            </div>
                            <div class="ps-blog__content related-prd-content">
                                <h3>{{ ucwords(strtolower($subcategory->name)) }}</h3>
                                <p>{{$subcategory->shortdescription}}</p>
                                <div class="ps-banner btn-block">
                                    <a href="{{route('categorydetail',$subcategory->slug)}}" class="bg-warning ps-banner__shop">View Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
              
            </div>
        </div>
        </div>
</div>
    </section>
    
</div>
</div>
    
@endsection