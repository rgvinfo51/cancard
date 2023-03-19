@component('mail::message')
@php 
$fullname = $data['name'];                        
$purchasedoc = $data['purchasedoc'];
$email = $data['email'];
$phoneno = $data['phoneno'];
$sendtocustomer = $data['sendtocustomer'];
@endphp

@if($sendtocustomer == 0)
	<p>You have received an PO request from {{$fullname}}</p>
	<p>Fullname : {{$fullname}}</p>
	<p>Email : {{$email}}</p>
	<p>Phone : {{$phoneno}}</p>
	<p>Purchase Order : <a href="{{ asset('storage/uploads/orders/'.$purchasedoc) }}">Click Here</a></p>
@else
<p> Purchase Order : <a href="{{ asset('storage/uploads/orders/'.$purchasedoc) }}">Click Here</a>
@endif


Thanks,<br>
{{ config('app.name') }}
@endcomponent
