<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customerpricing;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon; 
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderPayment;
use App\Models\PaymentSetting;
use App\Models\User;
use Validator;
use DB;

class CheckoutController extends Controller
{
    public function checkoutdetail(Request $request){
        
         $cartdetails = new CartController;
         $cartitems=$cartdetails->getcartitems();
         if($cartitems->count()<=0){
             $messagetype="alerterror";
        $message="Empty Shopping cart";
        return redirect()->route('cart')->with($messagetype, $message);
         }
         $customerdata=array();
        if(Auth::check()){
              $customerdata = Auth::user();
             // $userid=$customerdata->id;
          }
        if (Session::has('coupon')) {
            $carttotals=array(
                'subtotal' => $cartdetails->CartSubTotal(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            );
        }else{
            $carttotals=array(
                'total_amount' => $cartdetails->CartSubTotal(),
                'subtotal' => $cartdetails->CartSubTotal(),
            );
        }

        $payment_methods = PaymentSetting::select('*')->where('user_id',$customerdata->id)->orderBy('set_default','DESC')->get()->toArray();
        $addresses = DB::table('addresses')->where('user_id',$customerdata['id'])->orderBy('set_default','DESC')->get();
        $default_address = DB::table('addresses')->where('user_id',$customerdata['id'])->where('set_default',1)->orderBy('set_default','DESC')->first();
        return view('frontend.checkout',compact('cartitems','carttotals','customerdata','payment_methods','addresses','default_address'));
    }

    public function getCheckoutSingleAddress(Request $request){
        return $payment_methods = DB::table('addresses')->where('id',$request->id)->first();
    }

    public function getCheckoutShippingAddress(Request $request){
        return $shipping_addres = DB::table('users')->where('id',$request->id)->first();
    }

    
   
    public function getCheckoutSingle(Request $request){
        return $payment_methods = PaymentSetting::select('*')->where('id',$request->id)->first();
    }
   
    public function CheckoutStore(Request $request){
        // echo "<pre>";
        // $user = Auth::user();
        // print_r($user);
        // die;
        if(!$request->from_po_upload){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'bfirstname' => ['required', 'string', 'max:255'],
                'blastname' => ['required', 'string', 'max:255'],
                'bstreetaddress1' => ['required', 'string', 'max:255'],
                'bcity' => ['required', 'string', 'max:255'],
                'bpostcode' => ['required', 'string', 'max:255'],
                'bcountry' => ['required', 'string', 'max:255'],
                'shipingaddress' => ['required'],
                ],
                [
                'email.required' => 'Required',
                'bfirstname.required' => 'Required',
                'blastname.required' => 'Required',
                'bstreetaddress1.required' => 'Required',
                'bcity.required' => 'Required',
                'bpostcode.required' => 'Required',
                'bcountry.required' => 'Required',
                'shipingaddress.required' => 'Shipping details required!!',
                ]
                );
        }
        /*if($request->diffrentshipping){
            $request->validate([
                'sfirstname' => ['required', 'string', 'max:255'],
                'slastname' => ['required', 'string', 'max:255'],
                'sstreetaddress1' => ['required', 'string', 'max:255'],
                'scity' => ['required', 'string', 'max:255'],
                'spostcode' => ['required', 'string', 'max:255'],
                'scountry' => ['required', 'string', 'max:255'],
                ],
                [
                'sfirstname.required' => 'Required',
                'slastname.required' => 'Required',
                'sstreetaddress1.required' => 'Required',
                'scity.required' => 'Required',
                'spostcode.required' => 'Required',
                'scountry.required' => 'Required',
                ]
                );
        }*/
        // echo "Data";
        // die;
        if($request->payment_type=='Purchase Order'){
            $request->validate([
                'purchaseno' => 'required_without:purchasedoc',
                'purchasedoc' => 'required_without:purchaseno',
                ],
                [
                'purchasedoc.required' => 'Required',
                'purchasedoc.required_without' => 'Please enter P.O Number Or upload P.O document',
                'purchaseno.required' => 'Required',
                'purchaseno.required_without' => 'Please enter P.O Number Or upload P.O document',
                ]
                );
        }
        $cartdetails = new CartController;
    	if (Session::has('coupon')) {
    		$total_amount = Session::get('coupon')['total_amount'];
    	}else{
    		$total_amount = $cartdetails->CartSubTotal();
    	}

	  // dd($charge);
        $userid=null;
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
              
          }
           $cartobj = new CartController;
        // Access method in TasksController
           $coupon_name=null;
           $discount_amount=null;
           $subtotal = $cartobj->CartSubTotal();
          if (Session::has('coupon')) {
                
                $coupon_name= session()->get('coupon')['coupon_name'];
                $discount_amount = session()->get('coupon')['discount_amount'];
          }
          $purchasedoc=null;
         if($request->hasFile('purchasedoc')) {
            $purchasedoc = 'ci'.hexdec(uniqid()).'.'.request()->purchasedoc->getClientOriginalExtension();
            $request->purchasedoc->storeAs('uploads/orders/',$purchasedoc,'public');
        }
        
        if($request->from_po_upload){
            $default_shipping = DB::table('addresses')->Where('user_id','=',$user->id)->Where('set_default','=',1)->first();
            if(!empty($default_shipping)){
              $sfirstname = '';
              $slastname = '';
              $sstreetaddress1 = $default_shipping->address1;
              $sstreetaddress2 = $default_shipping->address2;
              $scity = $default_shipping->city;
              $spostcode =  $default_shipping->zipcode;
              $scountry = $default_shipping->country;
            }
            else{
              $sfirstname = '';
              $slastname = '';
              $sstreetaddress1 = '';
              $sstreetaddress2 = '';
              $scity = '';
              $spostcode =  '';
              $scountry = '';
            }
        }
        else{
            $sfirstname = $request->bfirstname;
            $slastname = $request->blastname;
            $sstreetaddress1 = $request->sstreetaddress1;
            $sstreetaddress2 = $request->sstreetaddress2;
            $scity = $request->scity;
            $spostcode = $request->spostcode;
            $scountry = $request->scountry;
        }

        //CUSTOMER First Time Address SAVE
        $customerdata=User::find($userid);
        if($customerdata->bill_firstname=='' || $customerdata->bill_lastname==''){
          $customerdata->bill_firstname=$request->bfirstname;
          $customerdata->bill_lastname=$request->blastname;
          $customerdata->bill_address1=$request->bstreetaddress1;
          $customerdata->bill_address2=$request->bstreetaddress2;
          $customerdata->bill_city=$request->bcity;
          $customerdata->bill_zipcode=$request->bpostcode;
          $customerdata->bill_country=$request->bcountry;
        }
        if($customerdata->ship_firstname=='' || $customerdata->ship_lastname==''){
          $customerdata->ship_firstname=$sfirstname;
          $customerdata->ship_lastname=$slastname;
          $customerdata->ship_address1=$sstreetaddress1;
          $customerdata->ship_address2=$sstreetaddress2;
          $customerdata->ship_city=$scity;
          $customerdata->ship_zipcode=$spostcode;
          $customerdata->ship_country=$scountry;
        }
              $customerdata->save();
        //CUSTOMER First Time Address SAVE      
        
         $paymentId=null;
        if ($request->has('stripeToken') && $request->has('payment_type') && $request->input('payment_type') === 'ONLINE') {
            \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));
            try {
                $res = \Stripe\Charge::create(array(
                    "amount" => $total_amount,
                    "currency" => "usd",
                    "source" => $request->input('stripeToken'), // obtained with Stripe.js
                    "description" => "payment."
                ));

                $paymentId = OrderPayment::insertPaymentResponse($userid, 'SUCCESS', $res->getLastResponse()->json);

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $paymentId =OrderPayment::insertPaymentResponse($userid, 'FAILED', $e->getJsonBody());
                Session::flash('fail-message', "Error! Please Try again.");
                return redirect()->back();
            } catch (\Exception $e) {
                $error = [
                    'error_code' => $e->getCode(),
                    'error_message' => $e->getMessage(),
                    'error_file' => $e->getFile(),
                    'error_line' => $e->getLine(),
                    'error_trace' => $e->getTraceAsString(),
                ];

                $paymentId =OrderPayment::insertPaymentResponse($userid, 'ERROR', $error);
                Session::flash('fail-message', "Error! Please Try again.");
                return redirect()->back();
            }

        }

        if($request->from_po_upload){
            $bfirstname = $user->bill_firstname;
            $blastname = $user->bill_lastname;
            $bstreetaddress1 = $user->bill_address1;
            $bstreetaddress2 = $user->bill_address2;
            $bcity = $user->bill_city;
            $bpostcode = $user->bill_zipcode;
            $bcountry = $user->bill_country;
            $phoneno = $user->phoneno;
            $email = $user->email;
            $companyname = $user->company;
            $ordernotes = '';
        }
        else{
            $bfirstname = $request->bfirstname;
            $blastname = $request->blastname;
            $bstreetaddress1 = $request->bstreetaddress1;
            $bstreetaddress2 = $request->bstreetaddress2;
            $bcity = $request->bcity;
            $bpostcode = $request->bpostcode;
            $bcountry = $request->bcountry;
            $phoneno = $request->phoneno;
            $email = $request->email;
            $companyname = $request->companyname;
            $ordernotes = $request->ordernotes;
        }
        $latestOrder = Order::orderBy('created_at','DESC')->first();
        $orderno = '#1'.str_pad($latestOrder->id + 1,8, "0", STR_PAD_LEFT);
     $order_id = Order::insertGetId([
     	'user_id' => $userid,
     	'orderno' => $orderno,
     	'payment_id' => $paymentId,
        'phone' => $phoneno,
     	'email' => $email,
        'companyname' => $companyname,
     	'ordernotes' => $ordernotes,
        
        'bfirstname' => $bfirstname,
     	'blastname' => $blastname,
     	'bstreetaddress1' => $bstreetaddress1,
     	'bstreetaddress2' => $bstreetaddress2,
     	'bcity' => $bcity,
     	'bpostcode' => $bpostcode,
     	'bcountry' => $bcountry,
        
        'sfirstname' => $sfirstname,
     	'slastname' => $slastname,
     	'sstreetaddress1' => $sstreetaddress1,
     	'sstreetaddress2' => $sstreetaddress2,
     	'scity' => $scity,
     	'spostcode' => $spostcode,
     	'scountry' => $scountry,
         
     	//'payment_type' => 'Cash On Delivery',
     	//'payment_type' => $request->payment_type,
        'payment_type' => (!empty($paymentId)) ? 'Online Paid' : $request->payment_type,
        'payment_method' => '',
     	
        'purchaseno' => $request->purchaseno,
     	'purchasedoc' => $purchasedoc,
     	 
     	'couponcode' =>  $coupon_name,
     	'discountamount' => $discount_amount,
         
     	'currency' =>  'CAD',
     	'subtotal' => $subtotal,
     	'totalamount' => $total_amount,

     	'invoice_no' => 'CC'.mt_rand(10000000,99999999),
     	'order_date' => Carbon::now()->format('d F Y'),
     	'order_month' => Carbon::now()->format('F'),
     	'order_year' => Carbon::now()->format('Y'),
     	//'status' => 'pending',
     	'status' => (!empty($paymentId)) ?'processing':'pending',
        'created_at' => Carbon::now(),	 

     ]);

     // Start Send Email 
     $invoice = Order::findOrFail($order_id);
        $cartitems=$cartdetails->getcartitems();
        foreach ($cartitems as $cartitem) {
            $itemprice=0;
             $item=$this->customerpricing($cartitem);
            if($cartitem->discountprice!=null && $cartitem->discountprice>=0)
            {
                $itemprice=$cartitem->discountprice;
            }
            else{
                $itemprice=$cartitem->price;
            }
            
           OrderItem::insert([
                   'order_id' => $order_id, 
                   'productid' => $cartitem->pid,
                   'productname' => $cartitem->productname,
                   'optionname' => $cartitem->optionname,
                   'qty' => $cartitem->qty,
                   'price' => $itemprice,
                   'created_at' => Carbon::now(),

           ]);
        }
        if(!$request->from_po_upload){
            $emailsend=$this->orderemail($order_id);
        }
        if (Session::has('coupon')) {
           Session::forget('coupon');
            
        }
        $sessionid=Session::getId();
            Cart::where('sessionid', $sessionid)->delete();
     //Cart::destroy();
        $messagetype="alertsuccess";
        $message="Your order has been placed successfully";
        // die;
        if($request->from_po_upload){
            
            $details=[
                'name' => $bfirstname." ".$blastname,                        
                'purchasedoc' => $purchasedoc, 
                'email' => $email, 
                'phoneno' => $phoneno,
                'sendtocustomer' => 0,
            ];
            Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\POMail($details));
            return redirect()->route('orders')->with('success_message','PO Updated Successfully');
        }
        return redirect()->route('cart')->with($messagetype, $message);

    }// end mehtod. 
    
    public function orderemail($orderid){
        //$orderid=25;
        $order =DB::table('orders')->Where('id','=',$orderid)->first();
        $orderitems=array();
        if($order){
            $orderids=array();
              $orderitems =DB::table('order_items')
                ->join('products','order_items.productid', '=', 'products.id')
                ->Where('order_items.order_id',$orderid)
                ->select('products.id','products.slug','products.productname','products.productimage','order_items.*')
                ->get();
              
        }
        $orderpaymentdetail=array();
        if($order->payment_id!=NULL){
            $orderpaymentdetail=OrderPayment::find($order->payment_id);
        }
         try {
            $details=[
                    'order' => $order,
                    'orderitems' => $orderitems,
                    'orderpaymentdetail' => $orderpaymentdetail,
                    'sendtocustomer' => 0,
                 ];
                Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\OrderMail($details));
                $details=[
                    'order' => $order,
                    'orderitems' => $orderitems,
                    'orderpaymentdetail' => $orderpaymentdetail,
                    'sendtocustomer' => 1,
                 ];
                Mail::to($order->email)->send(new \App\Mail\OrderMail($details));

            } catch (Exception $ex) {
                // Debug via $ex->getMessage();
                $messagetype="alerterror";
               $message="Something went wrong. Please try again";
             // return redirect()->route('requestquotelist')->with($messagetype, $message);
            }
    }
     public function CashOrder(Request $request){


    	if (Session::has('coupon')) {
    		$total_amount = Session::get('coupon')['total_amount'];
    	}else{
    		$total_amount = round(Cart::total());
    	}

	  // dd($charge);
        $userid=null;
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
           $cartobj = new CartController;
        // Access method in TasksController
           $coupon_name=null;
           $discount_amount=null;
          if (Session::has('coupon')) {
                $subtotal = $cartobj->CartSubTotal();
                $coupon_name= session()->get('coupon')['coupon_name'];
                $discount_amount = session()->get('coupon')['discount_amount'];
          }
     $order_id = Order::insertGetId([
     	'user_id' => $userid,
     	'phoneno' => $request->phoneno,
     	'email' => $request->email,
        'companyname' => $request->companyname,
     	'ordernotes' => $request->ordernotes,
        
        'bfirstname' => $request->bfirstname,
     	'blastname' => $request->blastname,
     	'bstreetaddress1' => $request->bstreetaddress1,
     	'bstreetaddress2' => $request->bstreetaddress2,
     	'bcity' => $request->bcity,
     	'bpostcode' => $request->bpostcode,
     	'bcountry' => $request->bcountry,
        
        'sfirstname' => $request->sfirstname,
     	'slastname' => $request->slastname,
     	'sstreetaddress1' => $request->sstreetaddress1,
     	'sstreetaddress2' => $request->sstreetaddress2,
     	'scity' => $request->scity,
     	'spostcode' => $request->spostcode,
     	'scountry' => $request->scountry,
         
     	'payment_type' => 'Cash On Delivery',
     	'payment_method' => 'Cash On Delivery',
     	 
     	'couponcode' =>  $coupon_name,
     	'discountamount' => $discount_amount,
         
     	'currency' =>  'CAD',
     	'amount' => $total_amount,

     	'invoice_no' => 'CC'.mt_rand(10000000,99999999),
     	'order_date' => Carbon::now()->format('d F Y'),
     	'order_month' => Carbon::now()->format('F'),
     	'order_year' => Carbon::now()->format('Y'),
     	'status' => 'pending',
     	'created_at' => Carbon::now(),	 

     ]);

     // Start Send Email 
     $invoice = Order::findOrFail($order_id);
     /*	$data = [
     		'invoice_no' => $invoice->invoice_no,
     		'amount' => $total_amount,
     		'name' => $invoice->name,
     	    'email' => $invoice->email,
     	    
     	];

     	Mail::to($request->email)->send(new OrderMail($data));
        */
     // End Send Email 


     $carts = Cart::content();
        $sessionid=Session::getId();
        $checkcartitem=Cart::where('sessionid',$sessionid)->get();
        $sessionid=Session::getId();
        $checkcartitem=Cart::where('sessionid',$sessionid)->get();
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.price', 'products.productimage', 'products.discountprice','cart.id','cart.qty','cart.optionid','products.id as pid')
                ->get();
        foreach($cartitems as $item){
            $item->optionname='';
            if($item->optionid!=null || $item->optionid!=''){
                 $itemoptiondetail= Productoptions::findorfail($item->optionid);
                 if($itemoptiondetail){
                    //$optionname=$itemoptiondetail->optionname;
                    //$optionprice=$itemoptiondetail->price;
                    //$optionfinalprice=$this->getoptionfinalprice($itemoptiondetail->id);
                    $item->optionname=$itemoptiondetail->optionname;
                    if($itemoptiondetail->price!='')
                    {$item->price=$itemoptiondetail->price;
                    }
                    
                    if($itemoptiondetail->discountprice!='')
                    {
                        $item->discountprice=$itemoptiondetail->discountprice;
                    }
                 }
            }
        }
     foreach ($cartitems as $cartitem) {
         $itemprice=0;
         
         if($cartitem->discountprice!=null && $cartitem->discountprice>=0)
         {
             $itemprice=$cartitem->discountprice;
         }
         else{
             $itemprice=$cartitem->price;
         }
         $item=$this->customerpricing($cartitem);
     	OrderItem::insert([
     		'order_id' => $order_id, 
     		'product_id' => $cartitem->id,
     		'productname' => $cartitem->productname,
     		'optionname' => $cartitem->optionname,
     		'qty' => $cartitem->qty,
     		'price' => $itemprice,
     		'created_at' => Carbon::now(),

     	]);
     }


     if (Session::has('coupon')) {
     	Session::forget('coupon');
     }

     //Cart::destroy();
      $messagetype="alertsuccess";
        $message="Your order has been placed successfully";
    

		return redirect()->route('cart')->with($messagetype, $message);
 

    } // end method 

     public function customerpricing($product){
        if (Auth::check())
        {
            $userid = auth::user()->getId();
             $customerpricing=Customerpricing::where('customerid',$userid)->get();
            // print_r($customerpricing);exit;
            foreach($customerpricing as $customerprice){
                           if($customerprice->productid==$product->pid){
                               $product->price=$customerprice->price;
                               $product->discountprice=$customerprice->discountprice;
                              // print_r($topproduct);
                               break;

                           }
            }
        }
         return $product;           
                
    }



}
 