@extends('admin.adminmaster')
@section('admincontent')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-4">
            
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Order {{ $order->orderno }}</h4>
            </div>
        </div>
        <div class="col-8">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <form method="post" action="{{route('adminorderupdate',$order->id)}}">
                    @csrf
                    <input type="hidden" name="purchasedoc" value="{{ $order->purchasedoc }}">
                    <input type="hidden" name="email" value="{{ $order->email }}">
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="catstatus" class="form-select" name="status">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>shipped</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                                </select>
                                @error('status')
                                <span class="input-invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="po_no">PO Number</label>
                            <input type="number" name="po_no" value="{{ $order->purchaseno }}" id="po_no" class="form-control" placeholder="Enter PO Number">
                        </div>

                        <div class="col-4">
                            <label for="price">Price</label>
                            <input type="number" name="price" value="{{ $order->totalamount }}" id="price" class="form-control" placeholder="Enter Price">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">  

                    <div class="right-con orders-con">
                        <p style="color: black;">Order {{ $order->orderno }} was placed on {{ $order->order_date }} and is currently {{ ucfirst($order->status) }}.</p><br/>

                        <div class="orders-details row">
                            <div class="order-content col-md-6 col-sm-12">
                                <div class="order-content-details">
                                    <h4>Billing Address</h4>
                                    <p id="order-p">{{ $order->bfirstname }} {{ $order->blastname }}</p>
                                    <p id="order-p"> {{ $order->bstreetaddress1 }}</p>
                                    <p id="order-p"> {{ $order->bstreetaddress2 }}</p>
                                    <p id="order-p"> {{ $order->bcity }} {{ $order->bpostcode }}</p>
                                    <p id="order-p"> {{ $order->bcountry }}</p>
                                    <p id="order-p"> {{ $order->email }}</p>
                                </div>
                            </div>
                            <div class="order-content col-md-6 col-sm-12">
                                <div class="order-content-details">
                                    <h4>Shipping Address</h4>
                                    @if($order->sfirstname=='' && $order->slastname=='')
                                    <p id="order-p">{{ $order->bfirstname }} {{ $order->blastname }}</p>
                                    <p id="order-p"> {{ $order->bstreetaddress1 }}</p>
                                    <p id="order-p"> {{ $order->bstreetaddress2 }}</p>
                                    <p id="order-p"> {{ $order->bcity }} {{ $order->bpostcode }}</p>
                                    <p id="order-p"> {{ $order->bcountry }}</p>
                                    <p id="order-p"> {{ $order->email }}</p>
                                    @else
                                    <p id="order-p">{{ $order->sfirstname }} {{ $order->slastname }}</p>
                                    <p id="order-p"> {{ $order->sstreetaddress1 }}</p>
                                    <p id="order-p"> {{ $order->sstreetaddress2 }}</p>
                                    <p id="order-p"> {{ $order->scity }} {{ $order->spostcode }}</p>
                                    <p id="order-p"> {{ $order->scountry }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        @if($order->purchasedoc!='')
                            <?php  $exists = Storage::disk('public')->exists('/uploads/orders/'.$order->purchasedoc);?>
                            @if($exists && $order->purchasedoc!=NULL)
                            @endif
                        @else
                        <div class="orders-deatils-1 row">
                            <div class="order-content col-md-12 col-sm-12">
                                <a href="{{route('admin.invoice',$order->id)}}" style="display: table-cell;vertical-align: middle;position: absolute;left: 85%;top: -50px;" class="btn btn-info shadow-lg">View/Print Invoice</a>
                                <div class="order-content-details">
                                    <table class="table ps-table ps-table--product">
                                        <thead>
                                            <tr>
                                                <th class="th-ps-product__thumbnail"></th>
                                                <th class="ps-product__name">Product name</th>
                                                <th class="ps-product__quantity">Quantity</th>
                                                <th class="ps-product__quantity">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($orderitems as $orderitem)
                                            <tr>
                                                <td>
                                                    <div class="">
                                                        <a class="ps-product__image" href="{{route('productdetail',$orderitem->slug)}}">
                                                            <figure><img src="{{ asset('storage/uploads/product/'.$orderitem->productimage) }}" width='150' height='150'></figure>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="ps-product__name"> <a href="{{route('productdetail',$orderitem->slug)}}">{{$orderitem->productname}}</a>
                                                    @if($orderitem->optionname!='')
                                                    <br><span>Option : {{$orderitem->optionname}}</span>
                                                    @endif
                                                </td>

                                                <td class="ps-product__quantity">
                                                    <p>{{$orderitem->qty}}<p>
                                                    </td>
                                                    <td class="ps-product__quantity">
                                                        <p>${{$orderitem->price}}<p>
                                                        </td>

                                                    </tr>

                                                    @endforeach

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!--  -->

                                <div class="orders-deatils-1 row">
                                    <div class="order-content col-md-6 col-sm-12">
                                        <div class="order-content-details">
                                            <h4>Sub Total : ${{ $order->subtotal }}</h4>
                                            @if($order->discountamount!=NULL)
                                            <h4>Discount  @if($order->couponcode!=NULL)
                                                ({{ $order->couponcode }})
                                                @endif

                                                : ${{ $order->discountamount }}</h4>
                                                @endif

                                                <h4>Total : ${{ $order->totalamount }}</h4>
                                                <h4>Payment Type : {{ $order->payment_type }}</h4>
                                                @if($order->payment_type=='Purchase Order')
                                                @if($order->purchaseno!='')
                                                <h4>Purchase Order No : {{ $order->purchaseno }}</h4>
                                                @endif
                                                @if($order->purchasedoc!='')
                                                    <?php  $exists = Storage::disk('public')->exists('/uploads/orders/'.$order->purchasedoc);?>
                                                    @if($exists && $order->purchasedoc!=NULL)
                                                    <h4>Purchase Order : 
                                                        <a href="{{ asset('storage/uploads/orders/'.$order->purchasedoc) }}" target="_blank" class=""/>Click Here</a>
                                                    </h4>
                                                    @endif
                                                @endif
                                                @endif
                                                @if(!empty($orderpaymentdetail) && $order->payment_type=='Online Paid')
                                                <h4>Payment Method : {{ $orderpaymentdetail->payment_method }}</h4>
                                                <h4>Transaction NO : {{ $orderpaymentdetail->txn_id }}</h4>
                                                <!--<h4>Transaction Status : {{ $orderpaymentdetail->txn_status }}</h4>-->
                                                @endif
                                            </div>
                                        </div>
                                            <div class="order-content col-md-6 col-sm-12">
                                            <form method="post" action="{{route('adminOrderInvoiceTypeUpdate',$order->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="1" name="invoice_type" {{($order->invoice_type == '1') ? 'checked' : ''}} id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                        Upload BV Invoice 
                                                        @if($order->invoice_type == '1')  (<span style="color:red">Uploaded</span>) @endif
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="2" name="invoice_type" id="flexRadioDefault2" {{($order->invoice_type == '2') ? 'checked' : ''}} >
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                        Generate Invoice automatically 
                                                        @if($order->invoice_type == '2')  (<span style="color:red">Generated</span>) @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">                                                         
                                                        <input id="invoice_file" accept="application/pdf" disabled name="invoice_file" type="file" class="form-control" value="" required>
                                                        @error('invoice_file')
                                                        <span  class="input-invalid-feedback error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                </div>
                                            </form>
                                            </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

                </div> <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Tracking Details</h4>
                                <p class="card-title-desc">Fill tracking information</p>
                                <form method="post" action="{{route('updatetrackingdetails',$order->id)}}" onsubmit="return ValidatForm()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="trackingno">Tracking No</label>
                                                <input id="trackingno" name="trackingno" type="text" class="form-control" value="{{ $order->trackingno }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">        
                                            <div class="mb-3">
                                                <label for="trackingurl">Tracking Link</label>
                                                <input id="trackingurl" name="trackingurl" oninput="ValidatForm()" id="trackingurl" type="text" title="Please Enter valid URL" class="form-control" value="{{ $order->trackingurl }}">
                                                <span id="url_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="trackingdetails">Tracking Notes</label>
                                                <input id="trackingdetails" name="trackingdetails" type="text" class="form-control" value="{{ $order->trackingdetails }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="ship_via">Ship Via</label>
                                                <input id="ship_via" name="ship_via" type="text" class="form-control" value="{{ $order->ship_via }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="fob">F.O.B</label>
                                                <input id="fob" name="fob" type="text" class="form-control" value="{{ $order->fob }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="terms">Terms</label>
                                                <input id="terms" name="terms" type="text" class="form-control" value="{{ $order->terms }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="sls_rep">SLS REP</label>
                                                <input id="sls_rep" name="sls_rep" type="text" class="form-control" value="{{ $order->sls_rep }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="um">U/M</label>
                                                <input id="um" name="um" type="text" class="form-control" value="{{ $order->um }}">
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Tracking Details</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <script>
                function ValidatForm(){
                    var url = $("#trackingurl").val();
                    if(url!=''){
                        if(isUrlValid(url)==false){
                            $("#url_error").html("<p class='text-danger'>PLease Enter Valid URL <br> example : https://www.example.com/</p>");
                            return false;
                        }else{
                            $("#url_error").text("");
                            return true;
                        }
                    }
                }

                function isUrlValid(url) {
                    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
                }

                $(document).ready(function () {       
                    $("input[name='invoice_type']:radio").click(function () {
                        if($(this).val() == '1'){
                            $('#invoice_file').prop('disabled', false);
                        }
                        else if($(this).val() == '2'){
                            $('#invoice_file').prop('disabled', true);
                        }
                        else {
                            $('#invoice_file').prop('disabled', true);
                        }

                    });
                });

            </script>
            @endsection