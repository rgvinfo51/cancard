@extends('admin.adminmaster')
@section('admincontent')
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Quote Details</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                    <div class="orders-details row">
                        <div class="order-content col-md-6 col-sm-12">
                            <div class="order-content-details">
                                <div><strong>ID</strong> : <span>{{ $quote->quoteno }}</span></div><br>
                                <div><strong>Name</strong> : <span>{{ $quote->firstname }} {{ $quote->lastname }}</span></div><br>
                                <div><strong>Email</strong> : <span>{{ $quote->email }}</span></div><br>
                                <div><strong>Date</strong> : <span>{{ $quote->created_at->format('d M Y') }}</span></div><br>
                                <div><strong>Message </strong> : <div>{{ $quote->message }}</div></div><br>
                            </div>
                        </div>
                    </div>
                    <div class="orders-deatils-1 row">
                       
                        <div class="order-content col-md-12 col-sm-12">
                            <div class="order-content-details"><br>
                                <strong>Products</strong>
                            
                                <table class="table ps-table ps-table--product">
                                 <thead>
                                     <tr>
                                         <th class="th-ps-product__thumbnail"></th>
                                         <th class="ps-product__name">Product name</th>
                                         <th class="ps-product__quantity">Quantity</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     
                                     @foreach($quoteitems as $quoteitem)
                                         <tr>
                                         <td>
                                             <div class="">
                                                 <a class="ps-product__image" href="{{route('productdetail',$quoteitem->slug)}}">
                                                     <figure><img src="{{ asset('storage/uploads/product/'.$quoteitem->productimage) }}" width='200' height="200"></figure>
                                                 </a>
                                             </div>
                                         </td>
                                         <td class="ps-product__name"> <a href="{{route('productdetail',$quoteitem->slug)}}">{{$quoteitem->productname}}</a>
                                         @if($quoteitem->optionname!='')
                                         <br><span>Option : {{$quoteitem->optionname}}</span>
                                          @endif
                                         </td>

                                         <td class="ps-product__quantity">
                                             <p>{{$quoteitem->qty}}<p>
                                         </td>

                                     </tr>

                                     @endforeach

                                 </tbody>
                             </table>
                            </div>
                        </div>
                    </div>
        </div>
                   </div>
               </div> <!-- end col -->

           </div> <!-- end row -->

            </div>
@endsection