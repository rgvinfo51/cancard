<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productoptions;
use App\Models\Coupon;
use App\Models\Quote;
use App\Models\Quoteitem;
//use Gloudemans\Shoppingcart\Facades\Quoteitem;
use Auth;
//use App\Models\Wishlist;
use Carbon\Carbon;
use DB;
//use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
//use App\Models\ShipDivision; 
//use Illuminate\Support\Facades\Mail;
use Mail; 
class QuoteController extends Controller
{
    public function AddToQuoteitem(Request $request, $id){
        $sessionid=Session::getId();
          
    	$product = Product::findOrFail($id);
        $productoption='';
        if($product)
        {
            if(isset($request->optionid))
            {
                $productoption=Productoptions::findOrFail($request->optionid);
                if($productoption){
                    
                }
                else{
                    return response()->json(['error' => 'Something went wrong. Pease try again']);
                }
                
                $checkcartitem=Quoteitem::where('quoteid',$sessionid)->where('productid',$id)->where('optionid',$request->optionid)->first();
            }  
            else{
                $checkcartitem=Quoteitem::where('quoteid',$sessionid)->where('productid',$id)->first();
                
            }
            if($checkcartitem){
                
                $itemqty=$checkcartitem->qty+$request->qty;
                Quoteitem::findorfail($checkcartitem->id)->update([
                   'qty' => $itemqty, 
                  ]);
                return response()->json(['success' => 'Successfully added in you quote list']);
            }
            else{
                if($productoption){
                     $optionid=$request->optionid;
                }
                else{
                    $optionid=null;
                }
                 Quoteitem::create([
                            'productid' => $id, 
                            'quoteid' => $sessionid, 
                            'qty' => $request->qty, 
                            'optionid' => $optionid, 
                    ]);
                 
                 return response()->json(['success' => 'Successfully added in you quote list']);
            }
            
        }else{
            return response()->json(['error' => 'Something went wrong. Pease try again']);
        }
    } // end mehtod 


    // Mini Quoteitem Section
    public function requestquotelist(){

        $sessionid=Session::getId();
          
        $checkcartitem=Quoteitem::where('quoteid',$sessionid)->get();
        $quoteitems =DB::table('quoteitems')
                ->join('products','quoteitems.productid', '=', 'products.id')
                ->where('quoteitems.quoteid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.productimage','products.productimagealttext','quoteitems.id','quoteitems.qty','quoteitems.optionid')
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
        return view('frontend.requestquotelist',compact('quoteitems'));
    } // end method 
  
    public function removequoteitem(Request $request, $id){
        
        Quoteitem::findorfail($id)->delete();
        return redirect()->route('requestquotelist');
    } // end method 
    public function updatequoteitem(Request $request){
        
        $sessionid=Session::getId();
        $itemqty=$request->quantity;
            foreach($itemqty as $key => $value){
                $checkcartitem=Quoteitem::where('quoteid',$sessionid)->where('id',$key)->first();
                if($checkcartitem){
                    Quoteitem::findorfail($key)->update([
                       'qty' => $value, 
                      ]);
                }
            }
        return redirect()->route('requestquotelist');
    } // end method 
    
    
    public function myquotecount(){
        
        $sessionid=Session::getId();
          
        $checkcartitem=Quoteitem::where('quoteid',$sessionid)->count();
        
        if($checkcartitem){
           return $checkcartitem;
        }
        else{
            return 0;
        }
    } // end method 
    
    public function requestquote(Request $request){ 
        
        $sessionid=Session::getId();
        
        $validateData=$request->validate(
            [
                'firstname'=>'required',
                'lastname'=>'required',
                'email'=>'required',
            ],
            [
                'firstname.required'=>'Please enter your first name',
                'lastname.required'=>'Please enter your last name',
                'email.required'=>'Please enter email'
            ]
        );
        
        $userid=null;
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
          $latestquote = Quote::orderBy('created_at','DESC')->first();
        $quoteno = '#1'.str_pad($latestquote->id + 1,8, "0", STR_PAD_LEFT);
        $quoteid =Quote::insertGetId([
                            'quoteno' => $quoteno, 
                            'firstname' => $request->firstname, 
                            'lastname' => $request->lastname, 
                            'email' => $request->email, 
                            'message' => $request->message, 
                            'created_at' => Carbon::now(), 
                          //  'userid' => $userid, 
                        ]);
                 
        Quoteitem::where('quoteid', $sessionid)->update(['userid'=>$userid]);
        Quoteitem::where('quoteid', $sessionid)->update(['quoteid'=>$quoteid]);
        
        if($quoteid){
            $messagetype="alertsuccess";
            $message="Thank you for your quote request. We will get back to you shortly";
            $checkcartitem=Quoteitem::where('quoteid',$quoteid)->get();
            $quoteitems =DB::table('quoteitems')
                    ->join('products','quoteitems.productid', '=', 'products.id')
                    ->where('quoteitems.quoteid',$quoteid)
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
            try {
            $details=[
                    'quoteno' => $quoteno, 
                    'firstname' => $request->firstname, 
                    'lastname' => $request->lastname, 
                    'email' => $request->email, 
                    'comment' => $request->message, 
                    'quoteitems' => $quoteitems,
                    'sendtocustomer' => 0,
                 ];
                Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\QuoteMail($details));
                $details=[
                    'quoteno' => $quoteno, 
                    'firstname' => $request->firstname, 
                    'lastname' => $request->lastname, 
                    'email' => $request->email, 
                    'comment' => $request->message, 
                    'quoteitems' => $quoteitems,
                    'sendtocustomer' => 1,
                 ];
                Mail::to($request->email)->send(new \App\Mail\QuoteMail($details));

            } catch (Exception $ex) {
                // Debug via $ex->getMessage();
                $messagetype="alerterror";
               $message="Something went wrong. Please try again";
              return redirect()->route('requestquotelist')->with($messagetype, $message);
            }
           
        }
        else{
            $messagetype="alerterror";
            $message="Something went wrong. Please try again";
        }
        
        return redirect()->route('requestquotelist')->with($messagetype, $message);
    } // end method 
 

}
 