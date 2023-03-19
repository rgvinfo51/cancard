@component('mail::message')
@php 
$email=$data['email']; 
$quoteno=$data['quoteno'];
$fullname=$data['firstname'].' '.$data['lastname']; 
$comment= nl2br($data['comment']);
$quoteitems=$data['quoteitems'];

@endphp
# Hello Admin,
<p>Here are the details:</p>
<p>Quote No: {{$quoteno}}</p>
<p>Name: {{$fullname}}</p>
<p>Email: {{$email}}</p>
<p>Message: </p>
<p>{!! $comment !!}</p>
<br/>
#Items

 
@component('mail::table')
| Product Name         | Quantity         |         
 | :------------- | :------------- |
@foreach ($quoteitems as $quoteitem)
 | <a href="{{route('productdetail',$quoteitem->slug)}}">{{ Str::limit($quoteitem->productname, 60) }}</a> | {{$quoteitem->qty}}
 @endforeach

@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
