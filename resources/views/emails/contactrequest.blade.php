@component('mail::message')
@php 
$email=$data['email']; 
$fullname=$data['fullname']; 
$comment= nl2br($data['comment']); 
$phoneno= $data['phoneno']; 
@endphp
# Hello Admin,
<p>Here are the details:</p>
<p>Name: {{$fullname}}</p>
<p>Email: {{$email}}</p>
<p>Phone No: {{$phoneno}}</p>
<p>Message: </p>
<p>{!! $comment !!}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
