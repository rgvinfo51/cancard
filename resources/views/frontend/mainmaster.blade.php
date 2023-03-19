<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ URL::asset('frontend/img/favicon.ico') }}" rel="apple-touch-icon-precomposed">
    <link href="{{ URL::asset('frontend/img/favicon.ico') }}" rel="shortcut icon" type="image/png">
   
    <meta name="keywords" content="{{trim(View::yieldContent('metakeywords'))}}">
    @hasSection('sourcelink')
        <link rel="canonical" href="{{trim(View::yieldContent('sourcelink'))}}" />
     @endif
    @yield('sharingmetatag')
    
    <title>{{trim(View::yieldContent('title'))}}</title>
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/fonts/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:400,500,600,700&amp;display=swap&amp;ver=1607580870">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/lightGallery/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/lightGallery/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/noUiSlider/nouislider.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ URL::asset('frontend/css/webslidemenu.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/my-account.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <style type="text/css">
    a.gflag {
        vertical-align: middle;
        font-size: 15px;
        padding: 0px;
        background-repeat: no-repeat;
        background-image: url(//gtranslate.net/flags/16.png);
    }

    a.gflag img {
        border: 0;
    }

    a.gflag:hover {
        background-image: url(//gtranslate.net/flags/16a.png);
    }

    #goog-gt-tt {
        display: none !important;
    }

    .goog-te-banner-frame {
        display: none !important;
    }

    .goog-te-menu-value:hover {
        text-decoration: none !important;
    }

    body {
        top: 0 !important;
    }

    #google_translate_element2 {
        display: none !important;
    }
    .po_upload_success_message{
        position: absolute;
        top: 25%;
        left: 30%
        ;width: 40%;
        height: 40vh;
        border: 2px solid rgba(0,0,0,0.275);
        background-color: white;
        padding: 10px 50px;
        text-align: justify;
        border-radius: 2px;
        padding-top: 60px;
        color: #174ec6;
        box-shadow: 0 0 1rem rgb(0 0 0 / 30%);
    }

    .heart {
        /*font-size: 150px;color: #e00;*/
        animation: beat .25s 2 alternate;
        /*transform-origin: center;*/
    }

    /* Heart beat animation */
    @keyframes beat{
        to { transform: scale(1.4); }
    }

    .profile_label{
        color: #4054b2;
        font-weight: 600;
        font-size: 18px !important;
    }
    .input_field:disabled{
        border: 2px solid rgba(0,0,0,0.1);
        opacity: 0.7 !important;
    }

    .input_field{
        background-color: white;
        border: 2px solid rgba(0,0,0,0.175);
        border-radius: 8px;
    }
    
</style>

<script src="{{ URL::asset('frontend/plugins/jquery.min.js') }}"></script>
<script src="{{ URL::asset('frontend/js/main.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L3WPDVKZH3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-L3WPDVKZH3');
</script>
</head>

<body>
    <div class="ps-page">
        @include('frontend.body.header')
        
         @yield('content')
        
        <!-- footer-->
         @include('frontend.body.footer')
    </div>
    <div class="ps-search">
        <div class="ps-search__content ps-search--mobile"><a class="ps-search__close" href="#" id="close-search"><i class="icon-cross"></i></a>
            <h3>Search</h3>
             <form method="post" action="{{ route('product.search') }}" id="searchform">
                 @csrf
                <div class="ps-search-table">
                    <div class="input-group">
                        <input class="form-control ps-input" type="text" placeholder="Search for products" name="search" id="searchinput" value="{!! !empty($searchterm) ? $searchterm : '' !!}">
                        <div class="input-group-append"><button type="submit"><i class="fa fa-search"></i></a></button></div>
                    </div>
                </div>
            </form>
            <div class="ps-search--result">
                <div class="ps-result__content">

                </div>
            </div>
        </div>
    </div>
   <!-- <div class="ps-navigation--footer">
        <div class="ps-nav__item"><a href="#" id="open-menu"><i class="icon-menu"></i></a><a href="#" id="close-menu"><i class="icon-cross"></i></a></div>
        <div class="ps-nav__item"><a href="index.html"><i class="icon-home2"></i></a></div>
        <div class="ps-nav__item"><a href="my-account.html"><i class="icon-user"></i></a></div>
        <div class="ps-nav__item"><a href="wishlist.html"><i class="fa fa-heart-o"></i><span class="badge">3</span></a></div>
        <div class="ps-nav__item"><a href="shopping-cart.html"><i class="icon-cart-empty"></i><span class="badge">2</span></a></div>
    </div>-->
    
    <button class="btn scroll-top"><i class="fa fa-angle-double-up"></i></button>
    <!-- <div class="ps-preloader" id="preloader">
       <div class="ps-preloader-section ps-preloader-left"></div>
        <div class="ps-preloader-section ps-preloader-right"></div>
    </div>-->
    <div class="modal fade" id="popupQuickview" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body">
                        <button class="close ps-quickview__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="ps-product--gallery">
                                        <div class="ps-product__thumbnail">
                                            <div class="slide"><img src="{{ URL::asset('frontend/img/products/001.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ URL::asset('frontend/img/products/047.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ URL::asset('frontend/img/products/047.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ URL::asset('frontend/img/products/008.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ URL::asset('frontend/img/products/034.jpg') }}" alt="alt" /></div>
                                        </div>
                                        <div class="ps-gallery--image">
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ URL::asset('frontend/img/products/001.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ URL::asset('frontend/img/products/047.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ URL::asset('frontend/img/products/047.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ URL::asset('frontend/img/products/008.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ URL::asset('frontend/img/products/034.jpg') }}" alt="alt" /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="ps-product__info">
                                        <div class="ps-product__badge"><span class="ps-badge ps-badge--instock"> IN STOCK</span>
                                        </div>
                                        <div class="ps-product__branch"><a href="#">HeartRate</a></div>
                                        <div class="ps-product__title"><a href="#">Blood Pressure Monitor</a></div>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4" selected="selected">4</option>
                                                <option value="5">5</option>
                                            </select><span class="ps-product__review">(5 Reviews)</span>
                                        </div>
                                        <div class="ps-product__desc">
                                            <ul class="ps-product__list">
                                                <li>Study history up to 30 days</li>
                                                <li>Up to 5 users simultaneously</li>
                                                <li>Has HEALTH certificate</li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__meta"><span class="ps-product__price">$77.65</span>
                                        </div>
                                        <div class="ps-product__quantity">
                                            <h6>Quantity</h6>
                                            <div class="d-md-flex align-items-center">
                                                <div class="def-number-input number-input safari_only">
                                                    <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                    <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                                    <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                                </div><a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcartV2">Add to cart</a>
                                            </div>
                                        </div>
                                        <div class="ps-product__type">
                                            <ul class="ps-product__list">
                                                <li> <span class="ps-list__title">Tags: </span><a class="ps-list__text" href="#">Health</a><a class="ps-list__text" href="#">Thermometer</a>
                                                </li>
                                                <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">SF-006</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="contactuspopup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered ps-quickview">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid ps-quickview__body p-0">
                        <button class="close ps-quickview__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-product--detail">
                            <div class="row">
                                <div class="col-12 col-xl-12 contactuspopupform">
                                    <h4>Contact Us</h4>
                                   <div class="text contact-form-block">
                                    <div class="contactform ">
                                        <form method="post" action="{{route('ajaxcontactrequest')}}" id="ajaxcontactus">
                                            @csrf
                                            <div class="contact-input-group">
                                            <input class="contact-input" type="text" name="fullname" placeholder="Your name*" required>
                                            </div>

                                            <div class="contact-input-group">
                                            <input class="contact-input" type="email" name="email" placeholder="Your email*" required>
                                            </div>
                                            <div class="contact-input-group">
                                            <input class="contact-input" type="tel" name="phoneno" placeholder="Your Phone">
                                            </div>
                                            <div class="contact-input-group">
                                            <textarea class="contact-input textarea"  name="message" placeholder="Your message*" required></textarea>
                                            </div> 

                                            <div class="contact-input-group">
                                            <input class="contact-btn" type="submit" name="" value="Submit">
                                            </div>
                                            <div id='ajaxcontacterrors'></div>
                                            <div id='ajaxcontactresults'></div>
                                        </form>
                                    </div>  
                                </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="homeinquirybtn"><a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#contactuspopup"><i class="fa fa-envelope"></i> Contact Us</a></div>
    
    
    <input type="hidden" value="{{url('/')}}" id="getbaseurlpath" name="getbaseurlpath">
    
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><!-- <script src="{{ URL::asset('frontend/plugins/jquery.min.js') }}"></script> -->
    <script src="{{ URL::asset('frontend/plugins/popper.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/lightGallery/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/noUiSlider/nouislider.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('frontend/js/webslidemenu.js') }}"></script>

@if(Session::has('success_message'))
    <div class="po_upload_success_message heart">
        <p style="color: #174ec6 !important;">Thank You for submitting your order. Our admin team will review the PO and send you an order confirmation at your registered email.</p>
        <center><button class="btn btn-primary mt-5" onclick="$('.po_upload_success_message').hide()">Close</button></center>
    </div>
@endif

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

    <!-- custom code-->
    <!-- <script src="{{ URL::asset('frontend/js/main.js') }}"></script> -->
    <script>
        $( document ).ready(function() {
            
            $("#ajaxcontactus").on("submit", function(e) {
            e.preventDefault();  
              $("#ajaxcontactresults").html('');
              $("#ajaxcontacterrors").html('');
             $.ajax({
                data:$('#ajaxcontactus').serialize(),
                dataType: "json",
                url : "{{ url('/ajaxcontactrequest') }}", 
                method : 'post',
                success:function(response){
                    
                    if(response.errors)
                    {    
                        $("#ajaxcontactresults").html('');
                    $("#ajaxcontacterrors").html(response.errors);
                    }
                    if(response.success)
                    {
                        $("#ajaxcontactresults").html(response.success);
                       window.location.href = response.redirecturl;
                    }
                    
                }

            }); // end ajax 
            
        });
        
            $("#ajaxregisterform").on("submit", function(e) {
            e.preventDefault();  
              $("#ajaxregisterresults").html('');
              $("#registererrors").html('');
             $.ajax({
                data:$('#ajaxregisterform').serialize(),
                dataType: "json",
                url : "{{ url('/ajaxregister') }}", 
                method : 'post',
                success:function(response){
                    
                    if(response.errors)
                    {    
                        $("#ajaxregisterresults").html('');
                    $("#registererrors").html(response.errors);
                    }
                    if(response.success)
                    {
                        $("#ajaxregisterresults").html(response.success);
                         $('#ajaxregisterform')[0].reset();
                       // window.location.href = response.redirecturl;
                    }
                    
                }

            }); // end ajax 
            
        });
            $("#ajaxloginform").on("submit", function(e) {
            e.preventDefault();  
              $("#results").html('');
              $("#loginerrors").html('');
             $.ajax({
                data:$('#ajaxloginform').serialize(),
                dataType: "json",
                url : "{{ url('/ajaxlogin') }}", 
                method : 'post',
                success:function(response){
                    
                    if(response.errors)
                    {    
                        $("#loginresults").html('');
                    $("#loginerrors").html(response.errors);
                    }
                    if(response.success)
                    {
                        $("#loginresults").html(response.success);
                        window.location.href = response.redirecturl;
                    }
                    
                }

            }); // end ajax 
            
        });
            $("#subscribeform").on("submit", function(e) {
            e.preventDefault();  
              $("#nsresults").html('');
              $("#subscribeerrors").html('');
             $.ajax({
                data:$('#subscribeform').serialize(),
                dataType: "json",
                url : "{{ url('/subscribe') }}", 
                method : 'post',
                success:function(response){
                    
                    if(response.errors)
                    {    
                        $("#nsresults").html('');
                    $("#subscribeerrors").html(response.errors);
                    }
                    if(response.success)
                    {
                        
                        $("#nsresults").html(response.success);
                        $('#subscribeform').trigger("reset");
                    }
                    
                }

            }); // end ajax 
            
        });

        });
    
    </script>
    <script type="text/javascript">
        
        function addToQuote(){
           // var product_name = $('#pname').text();
            var id = $('#pid').val();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data:$('#productaddtocart').serialize(),
                url: "{{ url('/quote/data/store') }}/"+id,
                success:function(data){

                    myquotecount()
                    //$('#closeModel').click();
                    // console.log(data)

                    // Start Message 
                    const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 3000
                        })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })

                    }else{
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })

                    }

                    // End Message 
                }
            })

        }
        function myquotecount(){
            $.ajax({
                type: 'GET',
                url: "{{ url('/quote-count') }}",
                dataType:'json',
                success:function(response){
                    $("#myquotecount").html("("+response+")");
                }
            })
            
        }
        myquotecount()
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".selectt").not(targetBox).hide();
                $(targetBox).show();
            });
        });
        
        function addToCart(){
           // var product_name = $('#pname').text();
            var id = $('#pid').val();
            var quantity = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data:$('#productaddtocart').serialize(),
                url: "{{ url('/cart/data/store') }}/"+id,
                success:function(data){

                    miniCart()
                    //$('#closeModel').click();
                    // console.log(data)

                    // Start Message 
                    const Toast = Swal.mixin({
                          toast: true,
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 3000
                        })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })

                    }else{
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })

                    }

                    // End Message 
                }
            })

        }
    </script>
    <script type="text/javascript">
     function miniCart(){
        $.ajax({
            type: 'GET',
            url: "{{ url('/product/mini/cart') }}",
            dataType:'json',
            success:function(response){

                //$('span[id="cartSubTotal"]').text(response.cartTotal);
                //$('#cartQty').text(response.cartQty);
                $('#minicartresults').html(response.carts);
                // $('#cartitemcount').html(response.cartitemcount);
                if(response.cartitemcount==0){
                    $('#cartitemcount').remove();
                }
                else{
                    $('#cartitemcount').html(response.cartitemcount);
                }
                //$(".ps-cart--mini").stop(true, true).addClass("active");     
                setTimeout(function() {
                        $(".ps-cart--mini").stop(true, true).removeClass("active");
                }, 2500);
                //$('#miniCart').html(miniCart);
            }
        })

     }
 miniCart();

 /// mini cart remove Start 
    function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
            miniCart();

             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                }

                // End Message 

            }
        });

    }

 //  end mini cart remove 

    function applyCoupon(){
    var coupon_name = $('#coupon_name').val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {coupon_name:coupon_name,"_token": "{{ csrf_token() }}"},
        url: "{{ url('/coupon-apply') }}",
        success:function(data){
               couponCalculation();
               if (data.validity == true) {
                $('#couponField').hide();
                $('#removecoupondiv').show();
               }
               
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message 

        }

    })
  }
  
  function couponRemove(){
        $.ajax({
            type:'GET',
            url: "{{ url('/coupon-remove') }}",
            dataType: 'json',
            success:function(data){
                couponCalculation();
                $('#coupon_name').val('');
                $('#removecoupondiv').hide();
                $('#couponField').show();
                
                

                 // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })

                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })

                }

                // End Message 

            }
        });

     }
     
     function couponCalculation(){
    $.ajax({
        type:'GET',
        url: "{{ url('/coupon-calculation') }}",
        dataType: 'json',
        success:function(data){
            if (data.discount_amount) {
                
                 $('#couponCalField').html(
                    `<div class="ps-shopping__row">
                            <div class="ps-shopping__label">Subtotal</div>
                            <div class="ps-shopping__price" translate="no">$ ${data.subtotal}</div>
                        </div>
                        <div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Coupon (${data.coupon_name})</div>
                                    <div class="ps-shopping__price" translate="no">$${data.discount_amount}</div>
                        </div>
                        <div class="ps-shopping__row">
                                    <div class="ps-shopping__label">Total Amount</div>
                                    <div class="ps-shopping__price" translate="no">$ ${data.total_amount}</div>
                        </div>`
                )

            }else{
                
                $('#couponCalField').html(
                    `<div class="ps-shopping__row">
                        <div class="ps-shopping__label">Subtotal</div>
                        <div class="ps-shopping__price" translate="no">$ ${data.subtotal}</div>

                    </div>
                    <div class="ps-shopping__row">
                                <div class="ps-shopping__label">Total Amount</div>
                                <div class="ps-shopping__price" translate="no">$ ${data.total_amount}</div>
                            </div>`
                )
            }
        }

    });
  }
 couponCalculation();
 
 function productoptionprice(){
     var price=$('#productoptionid option:selected').data('price');
     var discountprice= $('#productoptionid option:selected').data('discountprice');
     if(discountprice=='')
     {
        $('#productdiscountprice').html(price);
        $('#productprice').html('');
     }
     else{
         $('#productprice').html(price);
        $('#productdiscountprice').html(discountprice);
     }
 }
</script>
<script>
        $('.acnav__label').click(function () {
	var label = $(this);
	var parent = label.parent('.has-children');
	var list = label.siblings('.acnav__list');

	if ( parent.hasClass('is-open') ) {
		list.slideUp('fast');
		parent.removeClass('is-open');
	}
	else {
		list.slideDown('fast');
		parent.addClass('is-open');
	}
});
        
    </script>
    
<script type="text/javascript">
    function googleTranslateElementInit2() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            autoDisplay: false
        }, 'google_translate_element2');
    }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
<script type="text/javascript">
    /* <![CDATA[ */
    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
    /* ]]> */
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".i5 .ibox .irt li:nth-child(1)").addClass('act');
            $(".i5 .ibox .irt li ").hover(function() {
                $(".i5 .ibox .ilt img").eq($(this).index()).stop(true, false).addClass('act').siblings().stop(true, false).removeClass('act');
                $(this).stop(true, false).addClass('act').siblings().stop(true, false).removeClass('act');
            });
        });
    
</script>
<script type="text/javascript">
 var vsid = "kc233393eaa87ba";
 (function() { 
 var vsjs = document.createElement('script'); vsjs.type = 'text/javascript'; vsjs.async = true; vsjs.setAttribute('defer', 'defer');
  vsjs.src = 'https://www.leadchatbot.com/vsa/chat.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(vsjs, s);
 })();
</script>
</body>
</html>