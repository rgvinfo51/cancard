<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customerpricing;
use App\Models\Productoptions;
use App\Models\Application;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;
class WebproductController extends Controller
{
   

    public function categorydetail(Request $request)
    {
        $user = Auth::user();
          $maincatresults = DB::table('categories')->where('status','1')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
          
        if($maincatresults){  
            $subcatresults= DB::table('categories')->where('status','1')->where('parentid',$maincatresults->id)->orderBy('sortorder')->get();
          if(count($subcatresults) > 0)
          {
            $subcatids=array();
            foreach($subcatresults as $subcat){
                $subcatids[]=$subcat->id;
            }
            /*$productlist = DB::table('products')
                       ->join('categories', 'categories.id', '=', 'products.catid')
                    ->whereIn('products.catid', $subcatids)
                    ->where('products.status', 1)
                    ->orderBy('products.id','desc')
                     ->get();
             * 
             */
             $productlist = DB::table('products')->whereIn('products.catids', $subcatids)->where('products.status', 1)->orderBy('products.order', 'desc')->get();
             foreach($productlist as $product){
                    $product=$this->customerpricing($product);

                }
            $subcategories=Category::where('status', '1')->where('parentid','!=', null)->get();
            return view('frontend.categorydetail',['subcategorylist' => $subcatresults,'categorydetail'=>$maincatresults,'subcategories'=>$subcategories]);
          }
          else{
              
              $productlist = DB::table('products')->where('catids', $maincatresults->id)->where('products.status', 1)->orderBy('products.id', 'desc')->paginate(24);
               /* //->join('categories', 'categories.id', '=', 'products.catids')
                     // ->where('wishlist.userid', $userid)
                      //->where('products.status', 1)
                   //   ->select('products.*','categories.name AS categoryname')
                      ->orderBy('products.id', 'desc')
                      ->get();
                * 
                */
              foreach($productlist as $product){
                    $product=$this->customerpricing($product);

                }
            $subcategories=Category::where('status', '1')->where('parentid','!=', null)->get();
            return view('frontend.subcategorydetail',['productlist' => $productlist,'subcategorylist' => $subcatresults,'categorydetail'=>$maincatresults,'subcategories'=>$subcategories]);

          }
          
        }
        else{
            return redirect()->route('page404');
        }
          //print_r($productlist);echo 'da';
         // exit;
        
    }
    public function productdetail(Request $request)
    {
        $user = Auth::user();
          $productdetails = DB::table('products')->where('status','1')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
          $productgallery=array();
          $relatedproducts=array();
        if($productdetails){  
            //$subcatresults= DB::table('categories')->where('status','1')->where('parentid',$maincatresults->id)->orderBy('order', 'desc')->get();
          $productgallery = DB::table('productgalleries')->where('productid',$productdetails->id)->get();
          $categorydetails = DB::table('categories')->where('id',$productdetails->catids)->first();
          //$relatedproducts = DB::table('products')->where('status','1')->where('catids',$productdetails->catids)->where('id','!=',$productdetails->id)->get();
          
            if($productdetails->rplist!='')
            {
                $relatedproductlist=explode(",",$productdetails->rplist);
                $relatedproducts = DB::table('products')->whereIn('id', $relatedproductlist)->where('status', '=', 1)->get(['id','productname','productimage','slug','productimagealttext','metatitle']);
            }
          $productoptions=Productoptions::where('productid', $productdetails->id)->get();
          
        }
        else{
            return redirect()->route('page404');
        }
          //print_r($productlist);echo 'da';
         // exit;
         $categories=Category::where('status', '1')->where('parentid', null)->get();
        $subcategories=Category::where('status', '1')->where('parentid','!=', null)->get();
        $applications=Application::latest()->get();
        $productdetails=$this->customerpricing($productdetails);

        $user_reviews = DB::table('user_reviews')
                        ->join('users','users.id','=','user_reviews.user_id')
                        ->where('product_id',$productdetails->id)
                        ->orderBy('id','desc')
                        ->get(['users.name','users.lname','users.email','users.phoneno','user_reviews.*'])->toArray();

        $product_rating = '';
        if(!empty($user_reviews) && count($user_reviews) > 0){
          $sum = 0;
          foreach ($user_reviews as $key => $review) {
            $sum = $review->start_rating + $sum;
          }
          $product_rating =  ($sum*5)/(count($user_reviews)*5);
        }

        return view('frontend.productdetail',['applications' => $applications,'productdetails' => $productdetails,'productoptions' => $productoptions,'productgallery'=>$productgallery,'categorydetails'=>$categorydetails,'relatedproducts'=>$relatedproducts,'categories'=>$categories,'subcategories'=>$subcategories,'product_rating'=>$product_rating,'user_reviews'=>$user_reviews]);
    }
    public function customerpricing($product){
        if (Auth::check())
        {
            $userid = auth::user()->getId();
             $customerpricing=Customerpricing::where('customerid',$userid)->get();
            // print_r($customerpricing);exit;
            foreach($customerpricing as $customerprice){
                           if($customerprice->productid==$product->id){
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
