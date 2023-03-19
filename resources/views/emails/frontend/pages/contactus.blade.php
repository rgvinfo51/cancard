@extends('frontend.mainmaster')
@section('content')

<div class="contact-us-wrap">
<div class="ps-home__content maininnerpage">
        <div class="container-fluid">
            <section class="ps-banner--container row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="static-banner-block">
                        <div class="static-banner-img">
                                <img class="" src="{{ URL::asset('frontend/img/contact-us.jpg') }}"/>
                        </div>
                        <div class="ps-banner static-banner-content">
                            <h1 class="ps-banner__title text-white">Contact Us</h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
    <section class="ps-contact--info container">
        <div class="row">
            <div class="col-md-6 col-sm-12 ps-contact__info">
                <div class="text contact-info-block">
                    <h2>Get In Touch</h2>
                    <p>90 Nolan Ct, Unit 14, Markham, ON L3R 4L9 sales@cancard.com.</p>
                    
                    <h2>Call Us At</h2>
                    <p>Toll free: 1-855-949-1110</p>
                    <p>Phone: 1-647-910-1110</p>
                    <p>Fax: 1-877-966-1110</p>
                </div>
                <div class="text contact-form-block">
                    <div class="contactform">
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
                            <input class="contact-btn" type="submit" name="" value="Submit">
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        
            <div class="col-md-6 col-sm-12">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1479957.8900739378!2d-78.776954!3d43.57441!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4d360c38e36c5%3A0x394d088942c02ee7!2s90%20Nolan%20Ct%2C%20Markham%2C%20ON%20L3R%204L9%2C%20Canada!5e0!3m2!1sen!2sus!4v1624691118500!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
@endsection