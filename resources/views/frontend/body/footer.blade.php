 <section class="ps-section--newsletter ps-section--newsletter-inline">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-7">
                        <h3 class="ps-section__title">Join our newsletter</h3>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="ps-section__content">
                            <form method="post" action="{{route('subscribe')}}" id="subscribeform">
                                @csrf
                                <div class="ps-form--subscribe">
                                    <div class="ps-form__control">
                                        <input class="form-control ps-input" type="email" placeholder="Enter your email address" name="email">
                                        <button class="ps-btn ps-btn--warning">Subscribe</button>
                                    </div>
                                </div>
                                <div id='subscribeerrors'></div>
                                    <div id='nsresults'></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer-->
        <footer class="ps-footer ps-footer--8">
            <!--<div class="ps-footer--top">
                <div class="container-fluid">
                    <div class="row m-0">
                        <div class="col-12 col-sm-4 p-0">
                            <p class="text-center"><a class="ps-footer__link"><i class="icon-wallet"></i>100% Money back</a></p>
                        </div>
                        <div class="col-12 col-sm-4 p-0">
                            <p class="text-center"><a class="ps-footer__link"><i class="icon-bag2"></i>Non-contact shipping</a></p>
                        </div>
                        <div class="col-12 col-sm-4 p-0">
                            <p class="text-center"><a class="ps-footer__link"><i class="icon-truck"></i>Free delivery for order over $200</a></p>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="container-fluid">
                <div class="ps-footer__middle">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="ps-footer--address">
                                        <div class="ps-logo"><a href="index.html"> <img src="{{ URL::asset('frontend/img/cancard-logo.jpg') }}" alt><img class="logo-white" src="{{ URL::asset('frontend/img/cancard-logo.jpg') }}" alt><img class="logo-black" src="{{ URL::asset('frontend/img/cancard-logo.jpg') }}" alt><img class="logo-white-all" src="{{ URL::asset('frontend/img/cancard-logo.jpg') }}" alt><img class="logo-green" src="{{ URL::asset('frontend/img/logo-green.jpg') }}" alt></a></div>
                                        <div class="ps-footer__title">Our store</div>
                                        <p>90 Nolan Court, Unit 14,<br>Markham, ON L3R4L9</p>
                                        <p><a target="_blank" href="https://goo.gl/maps/LW9w8jaoPPzdJaRd6" target="_blank">Show on map</a></p>
                                        <ul class="ps-social">
                                           <!-- <li><a class="ps-social__link facebook" href="#"><i class="fa fa-facebook" target="_blank"> </i><span class="ps-tooltip">Facebook</span></a></li>
                                            <li><a class="ps-social__link instagram" href="#"><i class="fa fa-instagram" target="_blank"></i><span class="ps-tooltip">Instagram</span></a></li>-->
                                            <li><a class="ps-social__link facebook" href="https://www.facebook.com/Cancard-Inc-109653311606794" target="_blank"><i class="fa fa-facebook"></i><span class="ps-tooltip">Facebook</span></a></li>
                                            <li><a class="ps-social__link linkedin" href="https://www.linkedin.com/company/cancard-inc-" target="_blank"><i class="fa fa-linkedin"></i><span class="ps-tooltip">Linkedin</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="ps-footer--contact">
                                        <h5 class="ps-footer__title">Need help</h5>
                                        <div class="ps-footer__fax"><i class="icon-telephone"></i>855-949-1110</div>
                                        <p class="ps-footer__work">Monday - Friday: 9:00-20:00<br>Saturday: 11:00 - 15:00</p>
                                        <hr>
                                        <p><a class="ps-footer__email" href="#"> <i class="icon-envelope"></i>sales@cancard.com<span class="__cf_email__" data-cfemail="#"></span> </a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="ps-footer--block">
                                        <h5 class="ps-block__title">Information</h5>
                                        <ul class="ps-block__list">
                                            <li><a href="{{route('aboutus')}}">About us</a></li>
                                            <li><a href="#">Delivery information</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Sales</a></li>
                                            <li><a href="#">Terms &amp; Conditions</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="ps-footer--block">
                                        <h5 class="ps-block__title">Account</h5>
                                        <ul class="ps-block__list">
                                            <li><a href="{{route('dashboard')}}">My account</a></li>
                                            <li><a href="{{route('orders')}}">My orders</a></li>
                                            <li><a href="#">Returns</a></li>
                                            <li><a href="#">Shipping</a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div></div>
                <div class="ps-footer--bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <p>Copyright &COPY; 2021 Tracking and Identity Solutions - Cancard Inc.</p>
                        </div>
                        <div class="col-12 col-md-6 text-right"><img src="{{ URL::asset('frontend/img/payment.jpg') }}" alt><img class="payment-light" src="{{ URL::asset('frontend/img/payment-light.jpg') }}" alt></div>
                    </div>   </div>
                </div>
            </div>
        </footer>
        
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
        <script>
$(document).ready(function(){
  $(window).scroll(function(){
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 0) {
        $('.header').addClass('fadeOutLeft');
        $('.header').removeClass('fadeInLeft');
        $('.header-sticky').addClass('fadeInDown');
        $('.header-sticky').removeClass('fadeOutUp');
        $('.header-sticky').addClass('animated');      
    } else {
  $('.header').removeClass('fadeOutLeft');
        $('.header').removeClass('fadeInLeft');
        $('.header-sticky').removeClass('fadeInDown');
        $('.header-sticky').removeClass('fadeOutUp');
        $('.header-sticky').removeClass('animated'); 
    }
  });

  var curwidth = $(window).width();
  if(curwidth > 768){
var maxheight=0;
  $('.catepro .ps-section__item .ps-blog__content h3').css("height", "");
    $('.catepro .ps-section__item .ps-blog__content h3').each(function () {
        if ($(this).outerHeight() > maxheight) {
            maxheight = $(this).outerHeight();
        }
    });
    if (maxheight != 0){
        $('.catepro .ps-section__item .ps-blog__content h3').css({ 'height': maxheight + 'px' });
		}

        var maxheight=0;
  $('.sbbcatesec1 .ps-section__item .ps-blog__content h3').css("height", "");
    $('.sbbcatesec1 .ps-section__item .ps-blog__content h3').each(function () {
        if ($(this).outerHeight() > maxheight) {
            maxheight = $(this).outerHeight();
        }
    });
    if (maxheight != 0){
        $('.sbbcatesec1 .ps-section__item .ps-blog__content h3').css({ 'height': maxheight + 'px' });
		}
        var maxheight=0;
  $('.ps-section--also .ps-section__item .ps-blog__content h3').css("height", "");
    $('.ps-section--also .ps-section__item .ps-blog__content h3').each(function () {
        if ($(this).outerHeight() > maxheight) {
            maxheight = $(this).outerHeight();
        }
    });
    if (maxheight != 0){
        $('.ps-section--also .ps-section__item .ps-blog__content h3').css({ 'height': maxheight + 'px' });
		}
    }
        
});
</script>



      
  

