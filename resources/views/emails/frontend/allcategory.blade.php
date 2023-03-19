@extends('frontend.mainmaster')
@section('content')
<div class="breadcrumb-block breadcrumb-full">
    <ul class="ps-breadcrumb">
        <li class="ps-breadcrumb__item"><a href="{{url('/')}}">Home</a></li>
        <li class="ps-breadcrumb__item active" aria-current="page">Products</li>
    </ul>
</div>
<div class="ps-home ps-home--8">
            <div class="ps-home__content">
                <div class="container-fluid">
                    <section class="ps-section--banner ps-banner--container row"> 
                        <div class="col-md-8 col-sm-12 pdr-0">
                            <div class="static-banner-block">
                                <div class="static-banner-img">
                                    <img class="ps-banner__image" src="{{ URL::asset('frontend/img/slide2.jpg') }}" alt="alt" width="" height="150"/>
                                </div>
                                <div class="ps-banner static-banner-content">
                                    <h2 class="ps-banner__title text-white">Cancard offers collaborative solutions to an unique and diverse markets it serves, focusing attention on the specific needs and requirements of each client. </h2>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="ps-login col-md-4 col-sm-12 pdl-0">
                    <div class="home-login-register-wrap">
                    <div class="mx-auto home-login-register-block">
                        <div class="card-body pb-4">
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                              <form method="post">
                                <div class="form-group">
                                  <input type="email" class="form-control" name="username" placeholder="Email" required>
                                </div>

                                <div class="form-group">
                                  <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" id="customCheck1" checked="" type="checkbox">
                                  <label class="custom-control-label" for="customCheck1">Check me out</label>
                                </div>

                                <div class="text-center pt-4">
                                  <button type="submit" class=" btn btn-outline-primary">Login</button>
                                </div>

                                <div class="text-left pt-3">
                                  <a class="btn btn-link text-primary forgotpasswordlink" href="#">Forgot Your Password?</a>
                                </div>
                              </form>
                            </div>

                            <div class="tab-pane fade register-info-block show active" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                              <form >

                                <ul class="register-info-list"><h3>Register to access these great benefits!</h3>
                                        <li><i class="icon-check"></i> Discount pricing</li>
                                        <li><i class="icon-check"></i> Quick quotes and ordering</li>
                                        <li><i class="icon-check"></i> Track your orders</li>
                                        <li><i class="icon-check"></i> and more...</li>
                                </ul>   
                                <div class="text-left pt-2 pb-1 home-reg-link-block">
                                    <a href="{{ route('register') }}" class="btn-link">Learn More</a>
                                </div>
                                <div class="text-center pt-2 pb-1 d-flex home-reg-action-block">
                                    <a href="{{route('login')}}" class="btn btn-primary mr-3"><i class="icon-lock"></i> Login</a>
                                    <a href="{{route('register')}}" class="btn btn-secondary" data-toggle="modal" data-target="#loginpopup"><i class="icon-user"></i> Register</a>
                                </div>
                              </form>
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
            </div>

            
             
             
            <section class="ps-section--blog container-fluid">
                <div class="ps-section--category related-industries-category">
                    @foreach($allcategories as $appcategory)
                            <div class="ps-section__item">
                        <div class="ps-category__thumbnail"> 
                            <a class="ps-category__image" href="{{route('categorydetail',$appcategory->slug)}}">
                                 <?php  $exists = Storage::disk('public')->exists('/uploads/category/'.$appcategory->categoryimage);?>
                                    @if($exists && $appcategory->categoryimage!=NULL)
                                        <img class="" src="{{ asset('storage/uploads/category/'.$appcategory->categoryimage) }}"/>
                                    @else
                                    <img src='' alt="{{$appcategory->name}}">
                                    @endif
                            </a>
                            <div class="ps-category__content">
                                <a class="ps-category__name" href="{{route('categorydetail',$appcategory->slug)}}">{{$appcategory->name}}</a>
                                <p>{{$appcategory->shortdescription}}</p>
                                <a class="ps-category__more" href="{{route('categorydetail',$appcategory->slug)}}">View More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </section>
            

             <section class="ps-section--latest ">
            <div class="container-fluid">
                <h3 class="ps-section__title">Our Partners</h3>
                <div class="ps-section__carousel">
                    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="13000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-1.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-2.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-3.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-4.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-5.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-6.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-7.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-8.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-9.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product.html">
                                        <figure><img src="{{ URL::asset('frontend/img/branch/brand-1.jpg') }}" alt="alt" />
                                        </figure>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
               
            </div>
<div class="modal fade" id="loginpopup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body p-0">
                        <button class="close ps-quickview__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <img src="{{ URL::asset('frontend/img/slide1.jpg')}}" alt="alt" class="mb-3">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos rerum iusto maxime hic qui ratione delectus eaque possimus deserunt? Excepturi?</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos rerum iusto maxime hic qui ratione delectus eaque possimus deserunt? Excepturi?</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos rerum iusto maxime hic qui ratione delectus eaque possimus deserunt? Excepturi?</p>
                                </div>
                                <div class="col-12 col-xl-6 register-form">
                                    <h4>Register</h4>
                                    <x-jet-validation-errors class="mb-4" />
                                    <form method="POST" action="{{ route('ajaxregister') }}" id='ajaxregisterform'>
                                    @csrf
                                    <div>
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>

                                    <div>
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required />
                                    </div>

                                    <div>
                                        <x-jet-label for="phoneno" value="{{ __('Phone No') }}" />
                                        <x-jet-input id="phoneno" class="block w-full" type="text" name="phoneno" :value="old('phoneno')" required autofocus autocomplete="phoneno" />
                                    </div>

                                    <div>
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                                    </div>

                                    <div>
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                        <x-jet-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>

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
                                    <div id='results'></div>
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