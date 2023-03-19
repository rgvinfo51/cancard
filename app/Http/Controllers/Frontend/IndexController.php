<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\News;
use App\Models\Category;
use App\Models\Customerpricing;
use App\Models\Application;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use DB;
use Mail; 
use Validator;
use Illuminate\Mail\Mailable;
class IndexController extends Controller
{
    public function index(){
        $admindata = auth()->user();
        
        
        /*$categories=Category::where('status', '1')->where('parentid', null)->get();
        $subcategories=Category::where('status', '1')->where('parentid','!=', null)->get();
        $latestproducts=Product::latest()->get();*/
        $topproducts=Product::where('istopproduct','1')->where('status', '1')->select('productname','productimage','price','discountprice','id','slug','catids','shortdescription','metatitle','order','productimagealttext')->orderBy(\DB::raw('-`order`'), 'desc')->get();
            foreach($topproducts as $topproduct){
                $topproduct=$this->customerpricing($topproduct);
                $parentcategory=$this->getparenttopcategory($topproduct->catids);
                //echo $parentcategory;exit;
                
                if($parentcategory==null || $parentcategory=='')
                {   
                    $topproduct->topparentcategory=$topproduct->catids;
                }
                else {
                    $topparentcategory=$this->getparenttopcategory($parentcategory);
                    if($topparentcategory==null || $parentcategory==''){
                    $topproduct->topparentcategory=$parentcategory;
                }               
                }
                
            }
        $news=News::latest()->get();    
        //return view('frontend.index',compact('categories','subcategories','latestproducts'));
        return view('frontend.index',compact('topproducts','news'));
    }
    public function sitemap(){
        $xmlcategories = DB::table('categories')->where('status',1)->get();
        $xmlmainappresults = DB::table('applications')->where('status',1)->get();
        $xmlproducts = DB::table('products')->where('status',1)->get();
        return response()->view('frontend.pages.sitemap',compact('xmlcategories','xmlmainappresults','xmlproducts'))->header('Content-Type', 'text/xml');
    }
    public function getparenttopcategory($id)
    {
            $category=Category::findorfail($id);
            return $category->parentid;
            
            //$categories=Category::where('status', '1')->where('parentid', null)->get();
    }
    public function allproductscategory(Request $request)
    {
       
            $categories = DB::table('categories')->where('status',1)->where('parentid',null)->get();
            /*$categorylist=array();
            foreach($categories as $category){
                if($category->applications!='')
                {
                    $relatedapplication=explode(",",$category->applications);
                    if (in_array($mainappresults->id, $relatedapplication)){
                        $categorylist[]=$category->id;
                    }
                }
            }
            $relatedcategories = DB::table('categories')->whereIn('id', $categorylist)->where('status', '=', 1)->get(['id','name','categoryimage','slug','shortdescription']);
            **/
          //print_r($productlist);echo 'da';
         // exit;
        return view('frontend.allcategory',['allcategories' => $categories]);
    }
    public function applicationdetail(Request $request)
    {
        $user = Auth::user();
          $mainappresults = DB::table('applications')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
          
        if($mainappresults){
            $categories = DB::table('categories')->where('status',1)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get();
            $categorylist=array();
            foreach($categories as $category){
                if($category->applications!='')
                {
                    $relatedapplication=explode(",",$category->applications);
                    if (in_array($mainappresults->id, $relatedapplication)){
                        $categorylist[]=$category->id;
                    }
                }
            }
            $relatedcategories = DB::table('categories')->whereIn('id', $categorylist)->where('status', '=', 1)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get(['id','name','categoryimage','slug','shortdescription','categoryimagealttext']);

        }
        else{
            return redirect()->route('page404');
        }
          //print_r($productlist);echo 'da';
         // exit;
        return view('frontend.applicationdetail',['applicationdetail' => $mainappresults,'appcategories'=>$relatedcategories]);
    }
    public function StoreProductSearch(Request $request){

		$request->validate(["search" => "required"]);

		$item = $request->search;
		$searchterm = $request->search;
		// echo "$item";
                $categories = Category::where('status', '1')->orderBy('name','ASC')->get();
                $catids=array();
                $categoriessearch = Category::where('name','LIKE',"%$item%")->orderBy('name','ASC')->select('id','parentid')->get();
                //print_r($categoriessearch);exit;
                if($categoriessearch->count()>0){
                    foreach($categoriessearch as $catgory){
                        if($catgory->parentid==null){
                            $subcatid=Category::where('parentid',$catgory->id)->pluck('id')->toArray();
                            array_push($catids, $catgory->id);
                            if(count($subcatid)>0)
                            array_push($catids, $subcatid);
                        }
                        else{
                            array_push($catids, $catgory->id);
                        }
                    }
                }
                //print_r($catids);exit; 
                if(count($catids)>0)
		$products = Product::where('productname','LIKE',"%$item%")->orWhereIn('catids', $catids)->orWhere('shortdescription', 'LIKE', '%' . $item . '%')->orWhere('longdescription', 'LIKE', '%' . $item . '%')->paginate(12);
                else
		$products = Product::where('productname','LIKE',"%$item%")->orWhere('shortdescription', 'LIKE', '%' . $item . '%')->orWhere('longdescription', 'LIKE', '%' . $item . '%')->paginate(12);
                
                $products->appends($request->only('search'))->links();
                $activemaincategoryid=0;
                $activesubcategoryid=0;
                $activeindustryid=0;
        return view('frontend.store',['productlist' => $products,'searchterm'=>$searchterm,'activemaincategoryid' => $activemaincategoryid,'activesubcategoryid' => $activesubcategoryid,'activeindustryid' => $activeindustryid]);
	//	return view('frontend.store',compact('products','categories','searchterm'));

	} // end method 
    public function ProductSearch(Request $request){

		$request->validate(["search" => "required"]);

		$item = $request->search;
		$searchterm = $request->search;
		// echo "$item";
                $categories = Category::where('status', '1')->orderBy('name','ASC')->get();
                $catids=array();
                $categoriessearch = Category::where('name','LIKE',"%$item%")->orderBy('name','ASC')->select('id','parentid')->get();
                //print_r($categoriessearch);exit;
                if($categoriessearch->count()>0){
                    foreach($categoriessearch as $catgory){
                        if($catgory->parentid==null){
                            $subcatid=Category::where('parentid',$catgory->id)->pluck('id')->toArray();
                            array_push($catids, $catgory->id);
                            if(count($subcatid)>0)
                            array_push($catids, $subcatid);
                        }
                        else{
                            array_push($catids, $catgory->id);
                        }
                    }
                }
                //print_r($catids);exit;
                if(count($catids)>0)
		$products = Product::where('productname','LIKE',"%$item%")->orWhereIn('catids', $catids)->orWhere('shortdescription', 'LIKE', '%' . $item . '%')->orWhere('longdescription', 'LIKE', '%' . $item . '%')->paginate(24);
                else
		$products = Product::where('productname','LIKE',"%$item%")->orWhere('shortdescription', 'LIKE', '%' . $item . '%')->orWhere('longdescription', 'LIKE', '%' . $item . '%')->paginate(24);
                
                $products->appends($request->only('search'))->links();
		return view('frontend.search.search',compact('products','categories','searchterm'));

	} // end method 


	///// Advance Search Options 

	public function SearchProduct(Request $request){

		$request->validate(["search" => "required"]);

		$item = $request->search;		 
        
		$products = Product::where('productname','LIKE',"%$item%")->orWhere('shortdescription', 'LIKE', '%' . $item . '%')->orWhere('longdescription', 'LIKE', '%' . $item . '%')->select('productname','hideprice','productimage','price','id','slug','productimagealttext')->limit(5)->get();
                
                foreach($products as $product){
                    $product=$this->customerpricing($product);

                }
		return view('frontend.search.search_product',compact('products'));



	} // end method 
        
        public function UserLogout(){
    	Auth::logout();
    	return Redirect()->route('login');
    }
    public function store(){
        $activemaincategoryid=0;
        $activesubcategoryid=0;
        $activeindustryid=0;
        $productlist=Product::latest()->where('status','1')->paginate(12);
        return view('frontend.store',['productlist' => $productlist,'activemaincategoryid' => $activemaincategoryid,'activesubcategoryid' => $activesubcategoryid,'activeindustryid' => $activeindustryid]);
    }
    public function demostore(){
        $activemaincategoryid=0;
        $activesubcategoryid=0;
        $activeindustryid=0;
        $productlist=Product::latest()->where('status','1')->paginate(12);
        return view('frontend.store-second',['productlist' => $productlist,'activemaincategoryid' => $activemaincategoryid,'activesubcategoryid' => $activesubcategoryid,'activeindustryid' => $activeindustryid]);
    }
    public function storecategory(Request $request){
         $maincatresults = DB::table('categories')->where('status','1')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
          
        if($maincatresults){  
            $subcatresults= DB::table('categories')->where('status','1')->where('parentid',$maincatresults->id)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get();
            $activemaincategoryid=$maincatresults->parentid;
            $activesubcategoryid=$maincatresults->id;
            $activeindustryid=0;
            if(count($subcatresults) > 0)
            {
              $subcatids=array();
            
              foreach($subcatresults as $subcat){
                  $subcatids[]=$subcat->id;
                }
                $productlist = DB::table('products')->whereIn('products.catids', $subcatids)->where('products.status', 1)->orderBy('products.order', 'desc')->paginate(12);
            }
            else{
                $productlist = DB::table('products')->where('catids', $maincatresults->id)->where('products.status', 1)->orderBy('products.id', 'desc')->paginate(12);
            }
            foreach($productlist as $product){
                    $product=$this->customerpricing($product);

                }
            return view('frontend.store',['productlist' => $productlist,'activemaincategoryid' => $activemaincategoryid,'activesubcategoryid' => $activesubcategoryid,'activeindustryid' => $activeindustryid]);
        }
        else{
            return redirect()->route('page404');
        }
        $productlist=Product::latest()->where('status','1')->paginate(12);
        return view('frontend.store',compact('productlist'));
    }
    public function storeindustry(Request $request){
           $mainappresults = DB::table('applications')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
          
        if($mainappresults){
            $activemaincategoryid=0;
            $activesubcategoryid=0;
            $activeindustryid=$mainappresults->id;
            $categories = DB::table('categories')->where('status',1)->get();
            $categorylist=array();
            foreach($categories as $category){
                if($category->applications!='')
                {
                    $relatedapplication=explode(",",$category->applications);
                    if (in_array($mainappresults->id, $relatedapplication)){
                        if($category->parentid==null){
                            $subcatresults= DB::table('categories')->where('status','1')->where('parentid',$category->id)->orderBy(\DB::raw('-`sortorder`'), 'desc')->get();
                            $categorylist[]=$category->id;
                            if(count($subcatresults) > 0)
                            {
                              $subcatids=array();
                              foreach($subcatresults as $subcat){
                                  $subcatids[]=$subcat->id;
                                  $categorylist[]=$subcat->id;
                                }
                            }
                        }
                        else{
                            $categorylist[]=$category->id;
                        }
                    }
                }
            }
            $productlist = DB::table('products')->whereIn('products.catids', $categorylist)->where('products.status', 1)->orderBy('products.order', 'desc')->paginate(12);
            foreach($productlist as $product){
                    $product=$this->customerpricing($product);

                }
            return view('frontend.store',['productlist' => $productlist,'activemaincategoryid' => $activemaincategoryid,'activesubcategoryid' => $activesubcategoryid,'activeindustryid' => $activeindustryid]);
        }
        else{
            return redirect()->route('page404');
        }
        
        //$productlist=Product::latest()->where('status','1')->paginate(12);
        //return view('frontend.store',compact('productlist'));
    }
    
    public function ajaxcontactrequest(Request $request){
       
        $validation = Validator::make($request->all(), [
                            'fullname' => 'required',
                            'message' => 'required',
                            'email' => 'required|email',
                            'phoneno' => 'nullable|numeric',
                        ],
                        [
                            'name.required'=>'Please enter your full name',
                            'message.required'=>'Please your message',
                        ]);

        if ($validation->fails())  {  
            $errorsmessage = '';
            $x = 1;
            foreach ($validation->messages()->getMessages() as $field_name => $messages) {
                if ($x == 1)
                    $errorsmessage = $messages[0]; // messages are retrieved (publicly)
                else
                    $errorsmessage = $errorsmessage . '<br>' . $messages[0]; // messages are retrieved (publicly)
                $x++;
            }

            return response()->json(['errors' => $errorsmessage]);
        }
        /*else{
            //return response()->json(['success' => 'Request successfully submitted','redirecturl'=>route('thankyou')]);
        }*/
        try {
            $details=['fullname' => $request->fullname, 
                    'email' => $request->email, 
                    'phoneno' => $request->phoneno, 
                    'comment' => $request->message, 
                 ];
            //Mail::to('rinjalpatel21@gmail.com')->send($this->markdown('emails.c')->with('maildata', $request));
                Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\ContactMail($details));
                 /***Mail::send('emails.contactrequest',
                 array(
                    'fullname' => $request->fullname, 
                    'email' => $request->email, 
                    'comment' => $request->message, 
                 ), function($message) use ($request)
                 {
                     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                     $message->to('rinjalpatel21@gmail.com')->subject('Request Quote From'.$request->fullname);
                 });*/
             } catch (Exception $ex) {
                 // Debug via $ex->getMessage();
                 $messagetype="alerterror";
                $message="Something went wrong. Please try again";
               return redirect()->route('contactus')->with($messagetype, $message);
             }
        return response()->json(['success' => 'Request successfully submitted','redirecturl'=>route('thankyou')]);
       // return redirect()->route('thankyou');
    }
    public function contactrequest(Request $request){
       
       
        $validateData=$request->validate(
            [
                'fullname' => 'required',
                'message' => 'required',
                'email' => 'required|email',
                'phoneno' => 'nullable|numeric',
            ],
            [
                'name.required'=>'Please enter your full name',
                'message.required'=>'Please your message',
            ]
        );
        try {
            $details=['fullname' => $request->fullname, 
                    'email' => $request->email, 
                    'phoneno' => $request->phoneno, 
                    'comment' => $request->message, 
                 ];
                Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\ContactMail($details));
             
        } catch (Exception $ex) {
            // Debug via $ex->getMessage();
            $messagetype="alerterror";
           $message="Something went wrong. Please try again";
          return redirect()->route('contactus')->with($messagetype, $message);
        }
        return redirect()->route('thankyou');
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
    
    public function industrydemo(){
         $mainappresults = DB::table('applications')->where('slug','industrial')->orderBy('id', 'desc')->first();
        if($mainappresults){
            $categories = DB::table('categories')->where('status',1)->get();
            $categorylist=array();
            foreach($categories as $category){
                if($category->applications!='')
                {
                    $relatedapplication=explode(",",$category->applications);
                    if (in_array($mainappresults->id, $relatedapplication)){
                        $categorylist[]=$category->id;
                    }
                }
            }
            $relatedcategories = DB::table('categories')->whereIn('id', $categorylist)->where('status', '=', 1)->get(['id','name','categoryimage','slug','shortdescription','categoryimagealttext']);

        }
        else{
            return redirect()->route('page404');
        }
          //print_r($productlist);echo 'da';
         // exit;
        return view('frontend.pages.industry',['applicationdetail' => $mainappresults,'appcategories'=>$relatedcategories]);
        return view('frontend.pages.industry');
    }
    
    public function healthcaredemo(){
         $mainappresults = DB::table('applications')->where('slug','healthcare')->orderBy('id', 'desc')->first();
        if($mainappresults){
            $categories = DB::table('categories')->where('status',1)->get();
            $categorylist=array();
            foreach($categories as $category){
                if($category->applications!='')
                {
                    $relatedapplication=explode(",",$category->applications);
                    if (in_array($mainappresults->id, $relatedapplication)){
                        $categorylist[]=$category->id;
                    }
                }
            }
            $relatedcategories = DB::table('categories')->whereIn('id', $categorylist)->where('status', '=', 1)->get(['id','name','categoryimage','slug','shortdescription']);

        }
        else{
            return redirect()->route('page404');
        }
          //print_r($productlist);echo 'da';
         // exit;
        return view('frontend.pages.healthcare',['applicationdetail' => $mainappresults,'appcategories'=>$relatedcategories]);
        return view('frontend.pages.industry');
    }
    
}
