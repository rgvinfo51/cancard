<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Quote;
use App\Models\Quoteitem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productoptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Validator;
use App\Models\OrderPayment;
use Mail;

class OrderController extends Controller
{
   

    public function myorders()  {
      
        $orderlist=Order::orderBy('id','DESC')->get();
        $orderitems=array();
        //orderlist=array();
        /*if($orderlist->count()>0){
            $orderids=array();

             foreach($orderlist as $order){
                $orderids[]=$order->id;
            }
              $orderitems =DB::table('order_items')
                ->join('products','order_items.productid', '=', 'products.id')
                ->WhereIn('order_items.orderid',$orderids)
                ->select('products.id','products.slug','products.productname','products.productimage','order_items.id','order_items.qty','order_items.optionid','order_items.orderid')
                ->get();
        }*/
        return view('backend.order.orders',compact('orderlist'));
    }
    public function orderupdate($id,Request $request)  {
        $orderdetail=Order::find($id);
        $orderdetail->status=$request->status;
        $orderdetail->purchaseno=$request->po_no;
        $orderdetail->totalamount=$request->price;
        $status = $request['status'];
        $purchasedoc = $request['purchasedoc'];
        $email = $request['email'];
        // die;
        $orderdetail->save();
        if(!empty($purchasedoc) && $status=='cancelled'){
            $details=[
                'name' => 'name', 
                'purchasedoc' => $purchasedoc, 
                'email' => $email,
                'phoneno' => 'phone', 
                'sendtocustomer' => 1,
            ];
            Mail::to($email)->send(new \App\Mail\POMail($details));
        }
        $notification=array(
            'message'=>"Order Status Updated Successfully", 
            'action'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function adminOrderInvoiceTypeUpdate($id,Request $request)
    {
        $validateData=$request->validate(
            [
                'invoice_type' => 'required',
                'invoice_file'=>'nullable|mimes:pdf',
                
            ] 
        );        

        $invoice_fileName='';
         if($request->hasFile('invoice_file')) {
            // Storage::disk('public')->delete('/uploads/invoice_file/' . $oldbanner);
            $invoice_fileName = 'Invoice_'.$id.'.'.request()->invoice_file->getClientOriginalExtension();
            $request->invoice_file->storeAs('uploads/invoice_file',$invoice_fileName,'public');
        }
        
        $orderdetail=Order::find($id);
        $orderdetail->invoice_type=$request->invoice_type;
        $orderdetail->invoice_uploaded_file=$invoice_fileName;
        $orderdetail->save();
        $notification=array(
            'message'=>"Order Invoice created Successfully", 
            'action'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function updatetrackingdetails($id,Request $request)  {
        // return $request;
        // die;
        $orderdetail=Order::find($id);
        $orderdetail->trackingno=$request->trackingno;
        $orderdetail->trackingurl=$request->trackingurl;
        $orderdetail->trackingdetails=$request->trackingdetails;
        $orderdetail->ship_via=$request->ship_via;
        $orderdetail->fob=$request->fob;
        $orderdetail->terms=$request->terms;
        $orderdetail->sls_rep=$request->sls_rep;
        $orderdetail->um=$request->um;
        $orderdetail->save();
        $notification=array(
            'message'=>"Order tracking info Updated Successfully", 
            'action'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function orderdetail($id,Request $request)  {
        $order =DB::table('orders')->Where('id','=',$id)->first();
        $orderitems=array();
        $orderpaymentdetail=array();
        //orderlist=array();
        if($order){
            $orderids=array();
              $orderitems =DB::table('order_items')
                ->join('products','order_items.productid', '=', 'products.id')
                ->Where('order_items.order_id',$id)
                ->select('products.id','products.slug','products.productname','products.productimage','order_items.*')
                ->get();
              
        }
        if($order->payment_id!=NULL){
            $orderpaymentdetail=OrderPayment::find($order->payment_id);
        }

        // $po_upload =DB::table('po_upload')->where('user_id',$order->user_id)->orderBy('id','DESC')->first();
        // print_r($order);
        // print_r($orderitems);
        // print_r($orderpaymentdetail);
        // die;

        return view('backend.order.orderdetail',compact('order','orderitems','orderpaymentdetail'));
    }
    public function myquotes()  {
         
        $quotelist=Quote::orderBy('id','DESC')->get();
        $quoteitems=array();
        //quotelist=array();
        if($quotelist->count()>0){
            $quoteids=array();

             foreach($quotelist as $quote){
                $quoteids[]=$quote->id;
            }
              $quoteitems =DB::table('quoteitems')
                ->join('products','quoteitems.productid', '=', 'products.id')
                ->WhereIn('quoteitems.quoteid',$quoteids)
                ->select('products.id','products.slug','products.productname','products.productimage','quoteitems.id','quoteitems.qty','quoteitems.optionid','quoteitems.quoteid')
                ->get();
        }
        return view('backend.order.myquotes',compact('quotelist','quoteitems'));
    }
    
    public function myquotedetail(Request $request, $id)  {
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
          else{
              return redirect()->route('login');
          }
        $quote=Quote::where('id',$id)->first();
        $quoteitems=array();
        //quotelist=array();
        if($quote){
            $quoteids=array();
              $quoteitems =DB::table('quoteitems')
                ->join('products','quoteitems.productid', '=', 'products.id')
                ->Where('quoteitems.quoteid',$id)
                ->select('products.id','products.slug','products.productname','products.productimage','quoteitems.id','quoteitems.qty','quoteitems.optionid')
                ->get();
              foreach($quoteitems as $item){
            $item->optionname='';
            if($item->optionid!=null || $item->optionid!=''){
                 $itemoptiondetail= Productoptions::findorfail($item->optionid);
                 if($itemoptiondetail){
                    $item->optionname=$itemoptiondetail->optionname;
                 }
                 
            }
        }
        }
        return view('backend.order.myquotedetail',compact('quote','quoteitems'));
    }
    public function deletequote($id){
        $quote= Quote::findorfail($id);
        Quoteitem::where('quoteid', $id)->delete();
        Quote::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'Category deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcategories')->with($notification);
    }

    public function orderInvoice($id){
        $order =Order::select('orders.*', 'users.name')
                   ->join('users', 'users.id', '=', 'orders.user_id')
                   ->with('order_items')->where('orders.id',$id)->first()->toArray();
        return view('backend.order.orderinvoice',compact('order'));
    }
}
