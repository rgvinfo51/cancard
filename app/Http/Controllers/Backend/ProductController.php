<?php

namespace App\Http\Controllers\Backend;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Application;
use App\Models\Category;
use App\Models\Product;
use App\Models\Productoptions;
use App\Models\Productgallery;
use DB;
use Validator;
use Image;

class ProductController extends Controller
{
    public function productlist(){
        $products=Product::latest()->get();
        return view('backend.product.productlist',compact('products'));
    }
   
    public function addproduct(){
        $allproducts=Product::latest()->get();
        $categories=Category::latest()->get();
        $vendors=Vendor::latest()->get();
        $applications=Application::latest()->get();
        
        return view('backend.product.addproduct',compact('allproducts','categories','vendors','applications'));
    }
    public function storeproduct(Request $request){
        $istopproduct=0;
        $validateData=$request->validate(
            [
                'productname'=>'required',
                'status'=>'required',
                'slug'=>'required',
                'price'=>'required|integer|min:0',
            ],
            [
                'name.required'=>'Please enter product name',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter product slug'
            ]
        );
        
        if($request->istopproduct=='on')
            $istopproduct=1;
        
        $productimageName='';
        if($request->hasFile('productimage')) {
            $productimageName = 'pi'.hexdec(uniqid()).'.'.request()->productimage->getClientOriginalExtension();
            $request->productimage->storeAs('uploads/product',$productimageName,'public');
            $destinationPath = storage_path('app/public/uploads/product-thumbnail');
                $img = Image::make($request->productimage->path());
                $img->resize(300, 300, function ($constraint) {
                    //$constraint->aspectRatio();
                })->save($destinationPath.'/'.$productimageName);
               // $destinationPath = public_path('/images');
              //  $image->move($destinationPath, $productimageName);
            //$request->productimage->storeAs('uploads/product-thumbnail',$productimageName,'public');
        }
        $relatedproductlist='';
        if(isset($request['rplist'])){
            $relatedproductlist=implode(",",$request['rplist']);
        }
        $applications='';
        if(isset($request['applications'])){
            $applications=implode(",",$request['applications']);
        }
        $newproductid =Product::insertGetId([
          'productname'=>$request->productname,
          'slug'=>$request->slug, 
          'price'=>$request->price, 
          'status'=>$request->status,
          'productsku'=>$request->productsku,
          'productqty'=>$request->productqty,
          'discountprice'=>$request->discountprice,
          'rplist'=>$relatedproductlist,
          'applications'=>$applications,
          'vendorid'=>$request->vendorid,
          'producttags'=>$request->producttags,
          'longdescription'=>$request->longdescription,
          'shortdescription'=>$request->shortdescription,
          'productimage'=>$productimageName, 
          'catids'=>$request->catids, 
          'order'=>$request->order,
          'istopproduct'=>$istopproduct 
        ]);
        
        if(isset($request['add_option_name'])){
            foreach ($request['add_option_name'] as $key =>$value) {
                Productoptions::insert([
                'productid'=>$newproductid,
                'optionname'=>$value,
                'price'=>$request['add_option_price'][$key], 
                'discountprice'=>$request['add_option_discountprice'][$key],
              ]);
            }
        }
        $notification = array(
          'message'=> 'Product added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allproduct')->with($notification);
    }
    public function updateproduct(Request $request){
        $productid=$request->id;
        $oldimage=$request->oldimage;
        $oldEbrochure=$request->oldenglishbrochure;
        $oldFbrochure=$request->oldfrenchbrochure;
        $istopproduct=0;
        $validateData=$request->validate(
            [
                'productname'=>'required',
                'status'=>'required',
                'slug'=>'required',
                'price'=>'required|integer|min:0',
            ],
            [
                'productname.required'=>'Please enter product name',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter product slug'
            ]
        );
        if($request->istopproduct=='on')
            $istopproduct=1;
        
        $productimageName=$oldimage;
         if($request->hasFile('productimage')) {
             Storage::disk('public')->delete('/uploads/product/' . $oldimage);
            $productimageName = 'pi'.hexdec(uniqid()).'.'.request()->productimage->getClientOriginalExtension();
            $request->productimage->storeAs('uploads/product',$productimageName,'public');
             $destinationPath = storage_path('app/public/uploads/product-thumbnail');
                $img = Image::make($request->productimage->path());
                $img->resize(300, 300, function ($constraint) {
                    //$constraint->aspectRatio();
                })->save($destinationPath.'/'.$productimageName);
        }
        $englishbrochureName=$oldEbrochure;
         if($request->hasFile('englishbrochure')) {
             Storage::disk('public')->delete('/uploads/product/brochure/en/' . $oldEbrochure);
            $englishbrochureName = hexdec(uniqid()).'.'.request()->englishbrochure->getClientOriginalExtension();
            $request->englishbrochure->storeAs('uploads/product/brochure/en',$englishbrochureName,'public');
        }
        $frenchbrochureName=$oldFbrochure;
        if($request->hasFile('frenchbrochure')) {
             Storage::disk('public')->delete('/uploads/product/brochure/fr/' . $oldFbrochure);
            $frenchbrochureName = hexdec(uniqid()).'.'.request()->frenchbrochure->getClientOriginalExtension();
            $request->frenchbrochure->storeAs('uploads/product/brochure/fr',$frenchbrochureName,'public');
        }
        $relatedproductlist='';
        if(isset($request['rplist'])){
            $relatedproductlist=implode(",",$request['rplist']);
        }
        $applications='';
        if(isset($request['applications'])){
            $applications=implode(",",$request['applications']);
        }
        if(isset($request['option_name'])){
            foreach ($request['option_name'] as $key =>$value) {
                Productoptions::findorfail($key)->update([
                'optionname'=>$value,
                'price'=>$request['option_price'][$key], 
                'discountprice'=>$request['option_discountprice'][$key],
              ]);
            }
        }
        if(isset($request['add_option_name'])){
            foreach ($request['add_option_name'] as $key =>$value) {
                Productoptions::insert([
                'productid'=>$productid,
                'optionname'=>$value,
                'price'=>$request['add_option_price'][$key], 
                'discountprice'=>$request['add_option_discountprice'][$key],
              ]);
            }
        }
        Product::findorfail($productid)->update([
          'productname'=>$request->productname,
          'slug'=>$request->slug, 
          'price'=>$request->price, 
          'status'=>$request->status,
          'productsku'=>$request->productsku,
          'productqty'=>$request->productqty,
          'discountprice'=>$request->discountprice,
          'rplist'=>$relatedproductlist,
          'applications'=>$applications,
          'vendorid'=>$request->vendorid,
          'producttags'=>$request->producttags,
          'longdescription'=>$request->longdescription,
          'shortdescription'=>$request->shortdescription,
          'productimage'=>$productimageName, 
          'productimagealttext'=>$request->productimagealttext, 
          'catids'=>$request->catids, 
          'order'=>$request->order, 
          'metatitle'=>$request->metatitle, 
          'metakeywords'=>$request->metakeywords, 
          'metadescription'=>$request->metadescription, 
          'sourcelink'=>$request->sourcelink, 
          'englishbrochure'=>$englishbrochureName, 
          'frenchbrochure'=>$frenchbrochureName, 
          'istopproduct'=>$istopproduct, 
          'hideprice'=>$request->hideprice 
        ]);
        
            
      if(isset($request['removeimages'])){
                       //     Storage::disk('public')->delete('/uploads/product/' . $oldimage);
            $removeimageids = $request['removeimages'];
            foreach($removeimageids as $removeimageid){
                $rimage= Productgallery::findorfail($removeimageid);
                $productImage= $rimage->imagename;
                Storage::disk('public')->delete('/uploads/product/' . $productImage);
                Productgallery::findorfail($removeimageid)->delete();
                //File::delete($filename);
            }
         }

        if($request->hasFile('productgallery')) {
            $files = $request->file('productgallery');
            $i = 0;
            foreach ($files as $file) {
                $productimageName = 'pi'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                $file->storeAs('uploads/product',$productimageName,'public');
                Productgallery::create([
                    'productid' => $productid,
                    'imagename' => $productimageName,
                ]);
                $i ++;
            }
        }
        $notification = array(
          'message'=> 'Product updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allproducts')->with($notification);
    }
    public function deleteproduct($id){
        $product= Product::findorfail($id);
        Storage::disk('public')->delete('/uploads/product/' . $product->productimage);
        Storage::disk('public')->delete('/uploads/product-thumbnail/' . $product->productimage);
        Storage::disk('public')->delete('/uploads/product/brochure/fr/' . $product->frenchbrochure);
        Storage::disk('public')->delete('/uploads/product/brochure/en/' . $product->englishbrochure);
        Product::findorfail($id)->delete();
        Productoptions::where('productid', $id)->delete();
        $notification = array(
          'message'=> 'Product deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allproducts')->with($notification);
    }
    public function editproduct($id){
        $product= Product::findorfail($id);
        $allproducts= Product::where('id', '!=', $id)->get();
        $categories=Category::latest()->get();
        $vendors=Vendor::latest()->get();
        $applications=Application::latest()->get();
        $productgallery=Productgallery::where('productid',$id)->get();
        $productoptions=Productoptions::where('productid',$id)->get();
        
        return view('backend.product.editproduct',compact('product','allproducts','categories','vendors','applications','productgallery','productoptions'));
    }
    public function checkproductslug(Request $request)
    {
        //$slug = str_slug($request->title);
        $slug = SlugService::createSlug(Product::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
    
     public function exportproducts(){
        $products=Product::get();
        $categories = DB::table('categories')->get();
        $categorylist=array();
        foreach($categories as $category){
                            $categorylist[$category->id]=$category->name;
        }    
        
        $fileName = 'Products.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('id','productname', 'slug', 'productsku','category','price','discountprice','shortdescription','longdescription','istopproduct','sourcelink', 'status','metatitle', 'metakeywords','metadescription');

        $callback = function() use($products,$categorylist, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($products as $product) {
                
                
                 $row['id']  = $product->id;
                 $row['productname']  = $product->productname;
                $row['slug']    = url('/').'/'.$product->slug;
                $row['productsku']    = $product->productsku;
                if($product->catids!=''){
                $row['category']    = $categorylist[$product->catids];
                }else{
                    $row['category']    = '';
                }
                $row['price']    = $product->price;
                $row['discountprice']    = $product->discountprice;
                $row['shortdescription']    = $product->shortdescription;
                $row['longdescription']    = $product->longdescription;
                $row['istopproduct']    = $product->istopproduct;
                $row['sourcelink']    = $product->sourcelink;
                $row['status']  = $product->status;
                $row['metatitle']    = $product->metatitle;
                $row['metakeywords']  = $product->metakeywords;
                $row['metadescription']  = $product->metadescription;

                fputcsv($file, array($row['id'],$row['productname'], $row['slug'], $row['productsku'], $row['category'], $row['price'],$row['discountprice'], $row['shortdescription'], $row['longdescription'], $row['istopproduct'], $row['sourcelink'],$row['status'], $row['metatitle'], $row['metakeywords'],$row['metadescription']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        //return view('backend.product.productlist',compact('products'));
    }
    
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
    
    public function productpricingimport(){
        return view('backend.product.importproductprice');
    }
    public function productpricingimportprocess(Request $request)
    {
        //$file = public_path('file/test.csv');
        $this->validate(request(), [
            'productpricingcsv' => ['required',function ($attribute, $value, $fail) {
                if (!in_array($value->getClientOriginalExtension(), ['csv'])) {
                    $fail('Incorrect File Format.');
                }
            }]
        ]);
        
       $file = $request->file('productpricingcsv');
        $filename = 'cif'.hexdec(uniqid()).'.'.request()->productpricingcsv->getClientOriginalExtension();
         $request->productpricingcsv->storeAs('uploads/files',$filename,'public');
         $exists = Storage::disk('public')->exists('/uploads/files/'.$filename);
                $currentfile = Storage::disk('public')->path('/uploads/files/'.$filename);

         if (!$exists)
             return redirect()->back()->withErrors(['msg' => 'Something went wrong please try again']);
           // return false;
        
        $header = null;
        $customerArr = array();
        $delimiter=',';
        if (($handle = fopen($currentfile, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $customerArr[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        
            
        $data = [];
        $invalidrows = [];
        for ($i = 0; $i < count($customerArr); $i ++)
        {
            if(!array_key_exists("price",$customerArr[0])){
             return redirect()->back()->withErrors(['msg' => 'Price column missing']);
         }    
            //$users = User::where('email', '=', $customerArr[$i]['Email'])->first();
            $product= DB::table('products')->where('id', '=', $customerArr[$i]['id'])->first();
            if ($product) {
                $validator = Validator::make ($customerArr[$i], [
                    'price'=>'required|numeric|min:0',
                    'discountprice'=>'numeric',
                ]);
                if ($validator->fails()) {
                  $invalidrows[]=$i+1;
                }
                else{
                    if(array_key_exists("discountprice",$customerArr[$i])){
                       if($customerArr[$i]['discountprice']!='')
                        {
                           $discount=$customerArr[$i]['discountprice'];
                           if($discount==0){
                               $discount=null;
                           }
                            Product::findorfail($customerArr[$i]['id'])->update([
                            'price'=>$customerArr[$i]['price'], 
                            'discountprice'=>$discount
                            ]);
                        }
                        else{
                            Product::findorfail($customerArr[$i]['id'])->update([
                            'price'=>$customerArr[$i]['price'], 
                            ]);
                        }
                    }    
                    else{
                         Product::findorfail($customerArr[$i]['id'])->update([
                            'price'=>$customerArr[$i]['price'], 
                            ]);
                    }
                  
                }
                
            }
            else{
                $invalidrows[]=$i+1;
            }
            
            //User::firstOrCreate($customerArr[$i]);
        }
        $invalidrowstext='';
        if(count($invalidrows)>0){
            $invalidrowstext = implode(', ', $invalidrows);
        }
       // echo '<pre>';
       // print_r($invalidrows);echo '-------<br>';
       // print_r($data);
       //exit;
        //DB::table('users')->insert($data);
         $notification = array(
          'message'=> 'Prices Updated Successfully. ',
          'invalidrows'=> $invalidrowstext,
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
    }
}
