<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Customerpricing;
use App\Models\Application;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //$headercategories=Category::where('status', '1')->where('parentid', null)->get();
        //$headersubcategories=Category::where('status', '1')->where('parentid','!=', null)->get(); 
        $headercategories=DB::table('categories')->where('status', '=', 1)->where('parentid', null)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get();
        $headersubcategories=DB::table('categories')->where('status', '=', 1)->where('parentid','!=', null)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get();
        $headerindustries=Application::latest()->where('status','1')->get();
        $sessionid=Session::getId();
        $cartitems =DB::table('cart')
                ->join('products','cart.productid', '=', 'products.id')
                ->where('cart.sessionid',$sessionid)
                ->select('products.id','products.productname','products.price', 'products.productimage', 'products.discountprice','cart.id','cart.qty','products.id as pid')
                ->get();
        
        /*if (Auth::check())
        {
            $userid = auth::user()->getId();echo $userid;exit;
             $customerpricing=Customerpricing::where('customerid',$userid)->get();
            // print_r($customerpricing);exit;
             foreach($cartitems as $product){
                    foreach($customerpricing as $customerprice){
                           if($customerprice->productid==$product->pid){
                               $product->price=$customerprice->price;
                               $product->discountprice=$customerprice->discountprice;
                              // print_r($topproduct);
                               break;

                           }
                    }
                }
            
        }*/
        view()->share(['headercategories' => $headercategories,'headersubcategories' =>$headersubcategories,'headerindustries' =>$headerindustries,'cartitems' =>$cartitems]);
        
        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
        //return preg_match('/^[0-9]{10}+$/', trim($value));
            return preg_match('/^[0-9]{10}+$/', $value);
        
        });

    Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute',$attribute, ':attribute is invalid phone number');
        });
    }
  
}
