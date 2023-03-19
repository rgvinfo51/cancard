@component('mail::message')
@php 

$customer_id=$data['customer_id']; 
$email=$data['email']; 
$fullname=$data['name']; 
$phoneno=$data['phoneno']; 
$company=$data['company']; 
$posttitle=$data['posttitle']; 
$corporateaddress=$data['corporateaddress']; 
@endphp
# Hello {{$fullname}},
<p>Thank you for registration with us. We will verify all details and get back to you soon.</p>
<p>Following are the details you filled</p>
<p>Customer ID: {{$customer_id}}</p>
<p>Name: {{$fullname}}</p>
<p>Email: {{$email}}</p>
<p>Phone No: {{$phoneno}}</p>
<p>Company: {{$company}}</p>
<p>Post Title: {{$posttitle}}</p>
<p>Corporate Address: {{$corporateaddress}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
