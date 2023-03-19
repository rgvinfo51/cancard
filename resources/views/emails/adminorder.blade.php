@component('mail::message')
@php 
$order=$data['order'];
$orderno=$order->orderno;
$orderpaymentdetail=$data['orderpaymentdetail'];
$fullname=$order->bfirstname.' '.$order->blastname; 
$orderitems=$data['orderitems'];
$orderdate=$order->order_date;

$subtotal = $order->subtotal;
$couponcode = $order->couponcode;
$discountamount = $order->discountamount;
$totalamount = $order->totalamount;
$payment_type = $order->payment_type;
$purchasedoc = $order->purchasedoc;
$purchaseno=$order->purchaseno;

$orderpaymentdetailcheck=0;
$payment_method='';
$txn_id='';
if(!empty($orderpaymentdetail)){
$orderpaymentdetailcheck=1;
 $payment_method=$orderpaymentdetail->payment_method;
   $txn_id=$orderpaymentdetail->txn_id;
}

@endphp
# New Customer Order {{$orderno}},
<p>You have received an order from {{$fullname}}.</p>
<p>[Order {{$orderno}}] ({{ $orderdate }})</p>

#Items
@component('mail::table')

| Product Name         | Quantity         | Price         |         
| :------------- | :------------- | :------------- 
@foreach ($orderitems as $orderitem)
| {{ Str::limit($orderitem->productname, 60) }} | {{$orderitem->qty}} | {{$orderitem->price}}
 @endforeach
 
@endcomponent

@component('mail::table')
|     |     |
|-----|-----|
|Subtotal  |${{$subtotal}}   |
@if($couponcode!='')
|Discount({{$couponcode}})  |${{$discountamount}}   |
@endif
|Total  |${{$totalamount}}   |
|Payment Type  | {{$payment_type}}   |
@if($payment_type=='Purchase Order' && $order->purchaseno!='')
| Purchase Order No  | {{$purchaseno}}   |
@endif
@if($purchasedoc!=''&& $payment_type=='Purchase Order' )
|Purchase Order | <a href="{{ asset('storage/uploads/orders/'.$purchasedoc) }}">Click Here</a>   |
@endif
@if(!empty($orderpaymentdetailcheck) && $payment_type=='Online Paid')
| Payment Method  | {{ $payment_method }}   |
| Transaction NO  | {{ $txn_id }}   |
@endif
@endcomponent

@component('mail::table')

| Billing Address | Shipping Address |
| :------------- | :------------- |
@if($order->sfirstname=='' && $order->slastname=='')
| {{$order->bfirstname}} {{$order->blastname}} | {{$order->bfirstname}} {{$order->blastname}} |
| {{$order->bstreetaddress1}} | {{$order->bstreetaddress1}} |
| {{$order->bstreetaddress2}} | {{$order->bstreetaddress2}} |
| {{$order->bcity}} | {{$order->bcity}} |
| {{$order->bpostcode}} | {{$order->bpostcode}} |
| {{$order->bcountry}} | {{$order->bcountry}} |
| {{$order->email}} | |
}
@else
| {{$order->bfirstname}} {{$order->blastname}} | {{$order->sfirstname}} {{$order->sfirstname}} |
| {{$order->bstreetaddress1}} | {{$order->sstreetaddress1}} |
| {{$order->bstreetaddress2}} | {{$order->sstreetaddress2}} |
| {{$order->bcity}} | {{$order->scity}} |
| {{$order->bpostcode}} | {{$order->spostcode}} |
| {{$order->bcountry}} | {{$order->scountry}} |
| {{$order->email}} | |
@endif

@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
