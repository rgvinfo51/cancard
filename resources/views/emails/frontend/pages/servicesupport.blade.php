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
                            <h1 class="ps-banner__title text-white">SERVICE AND SUPPORT
                            <span class="service-heading-1">Cancard offers and supports complete hardware service coverage</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<div class="container">
    <div class="container main">
        <div class="service-program searvice-and-support-block">
            <h2>Service Program</h2>
            <div class="service-program-cons">
                <div class="service-program-con">
                    <div class="service-program-icon">
                        <img src="{{ URL::asset('frontend/img/maintenance.jpeg') }}" width="100" height="100">
                    </div>
                    <h3 class="service-program-heading">Preventive maintainance</h3>
                    <p>Periodic inspection and preventive maintenance.</p>
                </div>
                <div class="service-program-con">
                    <div class="service-program-icon">
                       <img src="{{ URL::asset('frontend/img/Responsive-services.jpeg') }}" width="100" height="100">
                    </div>
                    <h3 class="service-program-heading">Break Fix</h3>
                    <p>Responsive service on all products and services we sell.</p>
                </div>
                <div class="service-program-con">
                    <div class="service-program-icon">
                        <img src="{{ URL::asset('frontend/img/Thier-party.jpeg') }}" width="100" height="100">
                    </div>
                    <h3 class="service-program-heading">Third Party Agent</h3>
                    <p>Providing services on all qualified third party equipment.</p>
                </div>
            </div>
        </div>
        <div class="service-agreement">
            <h2>Service Agreement</h2>
            <div class="service-agreement-cons">
                <div class="service-agreement-con">
                    <div class="service-agreement-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                    <h4 class="service-agreement-heading">COMPREHENSIVE</h4>
                    <ul class="service-agreement-list">
                        <li>3 Scheduled preventative maintenance inspections annually, Labour and travel costs included.
                        </li>
                        <li>Cleaning, Lubricating and minor adjustments</li>
                        <li>Minor parts replacement if necessary (example Flex cables, springs, Screws) during
                            inspection visit.</li>
                        <li>Report any noticeable worn major components on work order.</li>
                        <li>Maintain a journal log of all service calls by machine. This journal is reviewed
                            periodically and significant trends will be discussed with client.</li>
                        <li>Emergency service requests will be performed on a demand basis including Labour and travel.
                        </li>
                        <li>Unlimited unscheduled emergency calls.</li>
                        <li>Unlimited Telephone support.</li>
                    </ul>
                </div>
                <div class="service-agreement-con">
                    <div class="service-agreement-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="service-agreement-heading">LIMITED</h4>
                    <ul class="service-agreement-list">
                        <li>3 Scheduled preventative maintenance inspections annually, Labour and travel costs included.
                        </li>
                        <li>Cleaning, Lubricating and minor adjustments</li>
                        <li>Minor parts replacement if necessary (example Flex cables, springs, Screws) during
                            inspection visit.</li>
                        <li>Report any noticeable worn major components on work order.</li>
                        <li>Maintain a journal log of all service calls by machine. This journal is reviewed
                            periodically and significant trends will be discussed with client.</li>
                        <li>Emergency service requests will be performed on a demand basis including Labour and travel.
                        </li>
                        <li>Limited to one unscheduled emergency call between pm inspections visits.</li>
                        <li>Additional emergency requests will be billed at our current published rate.</li>
                        <li>Unlimited Telephone support.</li>
                    </ul>
                </div>
                <div class="service-agreement-con">
                    <div class="service-agreement-icon">
                        <i class="fas fa-glasses"></i>
                    </div>
                    <h4 class="service-agreement-heading">INSPECTION ONLY</h4>
                    <ul class="service-agreement-list">
                        <li>3 Scheduled preventative maintenance inspections annually, Labour and travel costs included.
                        </li>
                        <li>Cleaning, Lubricating and minor adjustments</li>
                        <li>Minor parts replacement if necessary (example Flex cables, springs, Screws) during
                            inspection visit.</li>
                        <li>Report any noticeable worn major components on work order.</li>
                        <li>Maintain a journal log of all service calls by machine. This journal is reviewed
                            periodically and significant trends will be discussed with client.</li>
                        <li>Major components such as Main logic boards, control boards, motors are not covered under
                            this agreement.
                        </li>
                        <li>Emergency service calls will be billed at our current published rates.</li>
                        <li>Our agreement will not cover damage due to neglect or abuse.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="searvice-contact-info">
            <div class="row">
                <div class="col-6 service-contact">
                    <h3>For more information contact us.</h3>
                    <form class="service-contact-form">
                        <div class="service-input-group">
                            <input class="contact-input" type="text" name="" placeholder="Your name" required>
                        </div>

                        <div class="service-input-group">
                            <input class="contact-input" type="email" name="" placeholder="Your email" required>
                        </div>

                        <div class="service-input-group">
                            <textarea class="contact-input textarea" name="" placeholder="Your message" required></textarea>
                        </div>

                        <div class="input-group">
                            <input class="btn btn-primary" type="submit" name="" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection