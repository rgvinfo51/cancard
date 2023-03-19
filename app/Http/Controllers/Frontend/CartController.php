<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productoptions;
use App\Models\Customerpricing;
use App\Models\Cart;
use App\Models\Coupon;
//use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
//use App\Models\Wishlist;
use Carbon\Carbon;
use DB;
//use App\Models\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
//use App\Models\ShipDivision; 

 
class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        //return response()->json(['success' => 'Successfully Added on Your Cart']);
         $sessionid=Session::getId();
         if (Session::has('coupon')) {
           Session::forget('coupon');
        }
        $productoption='';  
    	$product = Product::findOrFail($id);
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
                
                $checkcartitem=Cart::where('sessionid',$sessionid)->where('productid',$id)->where('optionid',$request->optionid)->first();
            }  
            else{
                $checkcartitem=Cart::where('sessionid',$sessionid)->where('productid',$id)->first();
                
            }
            if($checkcartitem){
                
                $itemqty=$checkcartitem->qty+$request->qty;
                Cart::findorfail($checkcartitem->id)->update([
                   'qty' => $itemqty, 
                  ]);
                return response()->json(['success' => 'Successfully Added on Your Cart']);
            }
            else{
                if($productoption){
                     $optionid=$request->optionid;
                }
                else{
                    $optionid=null;
                }
                 Cart::create([
                            'productid' => $id, 
                            'sessionid' => $sessionid, 
                            'qty' => $request->qty, 
                            'optionid' => $optionid, 
                     
                            /*'options' => [
                                    'image' => $product->product_thambnail,
                                    'color' => $request->color,
                                    'size' => $request->size,
                            ],*/ 
                    ]);
                 
                 return response()->json(['success' => 'Successfully Added on Your Cart']);
            }
            
        }else{
            return response()->json(['error' => 'Something went wrong. Pease try again']);
        }
    } // end mehtod 


    // Mini Cart Section
    public function GetCartProduct(){

        $sessionid=Session::getId();
        $checkcartitem=Cart::where('sessionid',$sessionid)->get();
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.price', 'products.productimage','products.productimagealttext', 'products.discountprice','cart.id','cart.qty','cart.optionid','products.id as pid')
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
                    $item->price=$itemoptiondetail->price;
                    $item->discountprice=$itemoptiondetail->discountprice;
                 }
                 
            }
            $item=$this->customerpricing($item);
        }
        return view('frontend.cart',compact('cartitems'));
    } // end method 
    public function getcartitems(){

        $sessionid=Session::getId();
        $checkcartitem=Cart::where('sessionid',$sessionid)->get();
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.price', 'products.productimage','products.productimagealttext', 'products.discountprice','cart.id','cart.qty','cart.optionid','products.id as pid')
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
                    $item->price=$itemoptiondetail->price;
                    $item->discountprice=$itemoptiondetail->discountprice;
                 }
                 
            }
            $item=$this->customerpricing($item);
        }
        return $cartitems;
    } // end method 
    public function clearcart(){
        $sessionid=Session::getId();
       Cart::where('sessionid', $sessionid)->delete();
        return redirect()->route('cart');
    } // end method 
    public function removecartitem(Request $request, $id){
        
        Cart::findorfail($id)->delete();
        return redirect()->route('cart');
    } // end method 
    public function updatecart(Request $request){
        
        $sessionid=Session::getId();
        $itemqty=$request->quantity;
            foreach($itemqty as $key => $value){
                $checkcartitem=Cart::where('sessionid',$sessionid)->where('id',$key)->first();
                if($checkcartitem){
                    Cart::findorfail($key)->update([
                       'qty' => $value, 
                      ]);
                }
            }
        return redirect()->route('cart');
    } // end method 
    
    
    public function AddMiniCart(){

    	/*$carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();*/
        $sessionid=Session::getId();
        $checkcartitem=Cart::where('sessionid',$sessionid)->get();
        /*$minicarthtml = Cart::where('sessionid', $sessionid)
                            ->leftJoin('products', 'cart.productid', '=', 'products.id')
                            ->select('products.id','products.productname','products.price', 'products.discountprice','cart.id','cart.qty')->get();*/
        $minicarthtml='<ul class="ps-cart__items">';
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.price', 'products.productimage','products.productimagealttext', 'products.discountprice','cart.id','cart.qty','cart.optionid','products.id as pid')
                ->get();
        
        foreach($cartitems as $item){
            //$image=Storage::url('uploads/product/'.$item->productimage);
            $optiondetailhtml='';
            $item=$this->customerpricing($item);
            if($item->optionid!=null || $item->optionid!=''){
                //echo $item->optionid;exit;
                 $itemoptiondetail= Productoptions::findorfail($item->optionid);
                 if($itemoptiondetail){
                     $optionname=$itemoptiondetail->optionname;
                    $optionprice=$itemoptiondetail->price;
                    $optionfinalprice=$this->getoptionfinalprice($itemoptiondetail->id);
                    $optiondetailhtml='<p class="ps-product__meta"> <span class="ps-product__price">Option : '.$optionname.'</span></p>';
                    $optiondetailhtml.='<p class="ps-product__meta"> <span class="ps-product__price" translate="no">$'.$optionfinalprice.'</span><span> X '.$item->qty.'</span></p>';
                 }
                 else{
                    
                 }
            }
            $image=url('storage/uploads/product/'.$item->productimage);
            $minicarthtml=$minicarthtml.'<li class="ps-cart__item">
                                            <div class="ps-product--mini-cart"><a class="ps-product__thumbnail" href="#"><img src="'.$image.'" alt="'.$item->productimagealttext.'" /></a>
                                                <div class="ps-product__content"><a class="ps-product__name" href="#">'.$item->productname.'</a>';
                 if($optiondetailhtml==''){
                     $minicarthtml=$minicarthtml.'<p class="ps-product__meta"> <span class="ps-product__price" translate="no">$';
                     if($item->discountprice >0){
                        $minicarthtml=$minicarthtml. $item->discountprice;
                     }
                     else{
                         $minicarthtml=$minicarthtml. $item->price;
                     }
                    $minicarthtml=$minicarthtml.'</span><span> X '.$item->qty.'</span></p>';
                 }
                 else{ 
                     $minicarthtml=$minicarthtml.$optiondetailhtml;
                 }
            $minicarthtml=$minicarthtml.'</div><a class="ps-product__remove" href="javascript: void(0)"><i class="icon-cross"></i></a>
                                            </div>
                                        </li>';
                  
        }
        if($cartitems->count()<=0){
            $minicarthtml=$minicarthtml.'<li>No products in cart</li>';
            
        }
        else{
            //<div class="ps-cart__total"><span>Subtotal </span><span>$399</span></div>
            $minicarthtml=$minicarthtml.'<div class="ps-cart__footer"><a class="ps-btn ps-btn--outline" href="'.route("cart").'">View Cart</a><a class="ps-btn ps-btn--warning" href="'.route("checkout").'">Checkout</a></div>';
        }
        $minicarthtml=$minicarthtml.'</ul>';
        
    	return response()->json(array(
    		'carts' => $minicarthtml,
    		'cartitemcount' => $cartitems->count(),
    		//'cartTotal' => round($cartTotal),

    	));
    } // end method 
    public function getoptionfinalprice($id){
        $optiondetail= Productoptions::findorfail($id);
        if($optiondetail){
            if($optiondetail->discountprice>0 && $optiondetail->discountprice!=null ){
                return $optiondetail->discountprice;
            }
            else{
                return $optiondetail->price;
            }
        }
        else{
            return 'Invalid Option';
        }
        
    }
    
    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        //$coupon = Coupon::where('coupon_name',$request->coupon_name)->where('status','1')->first();
        if ($coupon) {
            $totalamount=$this->CartSubTotal();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round($totalamount * $coupon->coupon_discount/100), 
                'total_amount' => round($totalamount - $totalamount * $coupon->coupon_discount/100)  
            ]);
           // $messagetype="alertsuccess";
            //$message="Coupon Applied Successfully";
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
             
        }else{
            $messagetype="alerterror";
            $message="Invalid Coupon";
            return response()->json(['error' => 'Invalid Coupon']);
        }
        //return redirect()->route('cart')->with($messagetype, $message);
    }
    
    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => $this->CartSubTotal(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                //'total' => Cart::total(),
                'total_amount' => $this->CartSubTotal(),
                'subtotal' => $this->CartSubTotal(),
            ));

        }
    } // end method 


 // Remove Coupon 
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }
    
    public function CartSubTotal(){
         $sessionid=Session::getId();
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.slug','products.productname','products.price', 'products.productimage','products.productimagealttext', 'products.discountprice','cart.id','cart.qty','cart.optionid','products.id as pid')
                ->get();
        $totalamount=0;
        $subtotalamount=0;
        foreach($cartitems as $item){
            if($item->optionid!=null || $item->optionid!=''){
                 $itemoptiondetail= Productoptions::findorfail($item->optionid);
                 if($itemoptiondetail){
                    //$optionname=$itemoptiondetail->optionname;
                    //$optionprice=$itemoptiondetail->price;
                    //$optionfinalprice=$this->getoptionfinalprice($itemoptiondetail->id);
                    $item->optionname=$itemoptiondetail->optionname;
                    $item->price=$itemoptiondetail->price;
                    $item->discountprice=$itemoptiondetail->discountprice;
                 }
                 
            }
             $item=$this->customerpricing($item);
            if($item->discountprice!='')
               $subtotalamount=$subtotalamount+($item->discountprice * $item->qty);
            else
                $subtotalamount=$subtotalamount+($item->price * $item->qty);
            
          
        }
        return $subtotalamount;
    }
    
/// remove mini cart 
    public function RemoveMiniCart($rowId){
    	Cart::remove($rowId);
    	return response()->json(['success' => 'Product Remove from Cart']);

    } // end mehtod 

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

    // add to wishlist mehtod 

    /*public function AddToWishlist(Request $request, $product_id){

        if (Auth::check()) {

            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
               Wishlist::insert([
                'user_id' => Auth::id(), 
                'product_id' => $product_id, 
                'created_at' => Carbon::now(), 
            ]);
           return response()->json(['success' => 'Successfully Added On Your Wishlist']);

            }else{

                return response()->json(['error' => 'This Product has Already on Your Wishlist']);

            }            
            
        }else{

            return response()->json(['error' => 'At First Login Your Account']);

        }

    } // end method 
   



    public function CouponApply(Request $request){

        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
 
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
            
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    } // end method 


    public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }
    } // end method 


 // Remove Coupon 
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }



 // Checkout Method 
    public function CheckoutCreate(){

        if (Auth::check()) {
            if (Cart::total() > 0) {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
                
            }else{

            $notification = array(
            'message' => 'Shopping At list One Product',
            'alert-type' => 'error'
        );

        return redirect()->to('/')->with($notification);

            }

            
        }else{

             $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        );

        return redirect()->route('login')->with($notification);

        }

    } // end method 
    */





}
 