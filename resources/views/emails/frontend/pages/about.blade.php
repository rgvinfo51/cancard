@extends('frontend.mainmaster')
@section('content')
<div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                                <img class="" src="{{ URL::asset('frontend/img/slide3.jpg') }}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">About Us</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<div class="container aboutuspage">
    <section class="ps-about--info container">
        <div class="about-heading-con">
            <h4>At Cancard, we like to say that our products and services revolve around 
            <strong>marking, identifying and tracking</strong> (MIT for short). 
            We strive to fulfill that purpose as comprehensively as possible.
            </h4>
        </div>
    </section>
    <section class="ps-about--info container">
        <div class="ps-about__extent">
            <section class="ps-about--info container-fluid">
                <div class="ps-about__extent">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p style="color: rgba(0, 0, 0, 0.808); text-align: justify;">Our journey began in 1989 as Canadian Card Systems Inc., a start-up dealer for plastic card embossers and imprinters. With our focus on maintain customer uptime, through best in class onsite service, Cancard saw rapid adoption and grew into the multi-faceted technology sales and service company.</p>
                            <p style="color: rgba(0, 0, 0, 0.808); text-align: justify;">Our ambition to meet growing needs of our customer have helped us expand our core competencies in various areas like medication management, procedure carts, airborne decontamination, secure identification solutions, mobile ID, access management software and solutions, plastic card embossing, metal tag embossing, laser and thermal metal surface marking, employee picture ID, and many other solutions and services.</p>
                            <p style="color: rgba(0, 0, 0, 0.808); text-align: justify;">Cancard is strategically located in Markham, ON and next to all major highways, Toronto Airport and other major distribution hubs. Our central location allows us to get to any customer in the golden horseshoe area in less than 90 mins. Cancard has a dedicated team of very capable and industry renowned field-based service technicians who collectively have 75+ years of service experience and are dedicated to keep our customers running.</p>
                            
                          </div>
                        <div class="col-md-6 col-sm-12">
                            <div>
                            <img src="{{asset('public')}}/frontend/img/about1.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <p style="color: rgba(0, 0, 0, 0.808); text-align: justify;">Lastly, Cancard is born and raised in Canada and aspires to bring the Canadian values in our day to day operations and how we treat our customers, employees and vendors fairly.</p>
                        <p style="color: rgba(0, 0, 0, 0.808); text-align: justify;">While many of our products begin as generic off-the-shelf solutions, we also use our industry connections and expertise to offer custom changes and features to them as requested a service that many of our smaller competitors cannot match. We can handle a wide variety of requests for upgrades, adjustments and aesthetic changes to make sure your identification solution looks and functions exactly as you want it to.</>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
        @endsection