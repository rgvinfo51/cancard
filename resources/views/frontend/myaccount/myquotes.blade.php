@extends('frontend.mainmaster')
@section('content')

<main class="main-container myquotearea">
<div class="myaccount-wrap">
    <div class="container">
        <div class="myaccount-content-block">
            @include('frontend.myaccount.leftsidebar')
            
            <div class="right-con quote-con">
                <h2 id="quote-title">My Quotes</h2>
                @if(!$quotelist->isEmpty())
                
                <div class="orders-program">
                    <table class="orders-program-con">
                        <thead style="border-bottom: black 1px solid;">
                            <tr>
                                <th style="font-weight: bold;">Date</th>
                                <th style="font-weight: bold;">Quote ID</th>
                                <th style="font-weight: bold;">Name</th>
                                <th style="font-weight: bold;">Items</th>
                                <th style="font-weight: bold;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotelist as $quote)
                                <tr>
                                    <td>{{ $quote->created_at->format('d M Y') }}</td>
                                    <td>{{$quote->quoteno}}</td>
                                    <td>{{$quote->firstname}} {{$quote->lastname}}</td>
                                    <td>
                                        @foreach($quoteitems as $quoteitem)
                                            @if($quoteitem->quoteid==$quote->id)
                                            {{ Str::limit($quoteitem->productname, 40) }}
                                           <br/>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td><button class="view-btn"><a href="{{route('myquotedetail',$quote->id)}}">View</a></button></td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                @else
                    <span class="quotes">
                        No quote request available.
                    </span>
               @endif
            </div>
        </div>
    </div>
</div>
</main>
@endsection