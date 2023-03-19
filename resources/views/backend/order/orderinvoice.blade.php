<!DOCTYPE html>
<html>
<head>
    <title>Order Invoice </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/bootstrap4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <style>
        @media print {
          .noprint {
            visibility: hidden;
          }
        }

        @media print {
          .body {
            border-radius: 0px !important;
            box-shadow: none !important;
            margin:0px !important; 
          }
        }

        @media print {
            @page {
                margin-bottom: 0;
            }
            body {
                padding-bottom: 72px ;
            }
        }

    </style>
</head>
<body class="container shadow-lg my-5 py-3 body" style="border-radius: 8px;">
    <div class="clearfix">
        <div class="float-left">
            <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-outline-danger shadow-lg noprint">Go Back</a>
        </div>
        <div class="float-right">
            <button onclick="window.print()" class="btn btn-primary noprint shadow-lg">Print Invoice <i class="fas fa-print" aria-hidden="true"></i></button>
        </div>
    </div>
    
    <div class="main-content" id="main_content">
        <div class="row mt-5">
            <div class="col-9">
                <img src="https://cancard.com/frontend/img/cancard-logo.png">
                <p>
                    90 Nolan Court, Unit 14, <br>
                    Markham ON L3R 4L9 <br>
                    Tel: 647-910-1110 Fax: 1-877-966-1110 <br>
                    www.cancard.com <br>
                </p>
            </div>  
            <div class="col-3">
                <h1 class="text-center mt-2">Invoice</h1>
                <div class="row bg-light mt-2">
                    <div class="col-6">Number</div>
                    <div class="col-6">Date</div>
                </div>

                <div class="row mt-2">
                    <div class="col-6">{{$order['invoice_no']}}</div>
                    <div class="col-6">{{date('d-m-Y',strtotime($order['order_date']))}}</div>
                </div>
                <h5 class="text-center mt-2">REMITTANCE COPY</h5>           
            </div>  
        </div>

        <!-- Address -->
        <div class="row">
            <div class="col-6 pl-5">
                <div class="row">
                    <div class="col-3"><h5>BILL TO :</h5></div>
                    <div class="col-8">
                        <p class="m-0">{{ $order['bfirstname'] }} {{ $order['blastname'] }}</p>
                        <p class="m-0">{{ $order['bstreetaddress1'] }}</p>
                        <p class="m-0">{{ $order['bstreetaddress2'] }}</p>
                        <p class="m-0">{{ $order['bcity'] }} {{ $order['bpostcode'] }}</p>
                        <p class="m-0">{{ $order['bcountry'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6 pl-5">
                <div class="row">
                    <div class="col-3"><h5>SHIP TO :</h5></div>
                    <div class="col-8">
                        <p class="m-0">{{ $order['sfirstname'] }} {{ $order['blastname'] }}</p>
                        <p class="m-0">{{ $order['sstreetaddress1'] }}</p>
                        <p class="m-0">{{ $order['sstreetaddress2'] }}</p>
                        <p class="m-0">{{ $order['scity'] }} {{ $order['bpostcode'] }}</p>
                        <p class="m-0">{{ $order['scountry'] }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="container m-5 px-5">
            <div class="row">
                <div class="col-6">
                    <p class="mb-0"><strong>Customer #: {{ $order['name'] }}</strong></p>
                    <p><strong>{{ $order['email'] }}</strong></p>
                </div>
                <div class="col-6 pl-5">
                    <h5 class="pl-5"> </h5>
                </div>
            </div>
        </div>

        <div>
            <table class="table table-bordered">
                    <tr>
                        <th width="150">DUE DATE</th>
                        <th colspan="3">SHIP VIA</th>
                        <th>F.O.B</th>
                        <th>TERMS</th>
                        <th>P.O.NUMBER</th>
                        <th>ORD DATE</th>
                        <th>SLS REP</th>
                        <th>CURRENCY</th>
                        <th>ORD NO.</th>
                    </tr>

                    <tr>
                        <td><span style="font-size :16px;" class="font-weight-bold">{{date('d-m-Y',strtotime($order['order_date']))}}</span></td>
                        <td  colspan="3">{{$order['ship_via']}}</td>
                        <td>{{$order['fob']}}</td>
                        <td>{{$order['terms']}}</td>
                        <td>{{ $order['purchaseno'] }}</td>
                        <td>{{ $order['order_date'] }}</td>
                        <td>{{$order['sls_rep']}}</td>
                        <td>{{ $order['currency'] }}</td>
                        <td>{{ $order['orderno'] }}</td>
                    </tr>

                    <tr>
                        <th>PART NUMBER</th>
                        <th colspan="4">DESCRIPTION</th>
                        <th>U/M</th>
                        <th>ORD</th>
                        <th>SHIP</th>
                        <th>B.O</th>
                        <th>UNIT PRICE</th>
                        <th>EXT PRICE</th>
                    </tr>

                    @foreach($order['order_items'] as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td colspan="4">{{strip_tags($item['productname'])}}</td>
                            <td></td>
                            <td>{{$item['qty']}}</td>
                            <td></td>
                            <td></td>
                            <td><strong>${{$item['price']}}</strong></td>
                            <td><strong>${{$item['price']*$item['qty']}}</strong></td>
                        </tr>
                    @endforeach

            </table>

            <p class="text-center">2% SERVICE CHARGE WILL BE ADDED PER MONTH ON OVERDUE ACCOUNTS. GST # R1219-09642</p>

            <div class="sub-total" id="sub_total">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SUBTOTAL</th>
                            <th>N/A</th>
                            <th>FREIGHT</th>
                            <th>GST</th>
                            <th></th>
                            <th>TOTAL DUE</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><strong>${{ $order['subtotal']}}</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>0.0</td>
                            <td><strong>${{ $order['totalamount']}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>