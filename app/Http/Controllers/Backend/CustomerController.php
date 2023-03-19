<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Customertype;
use App\Models\Customerpricing;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Validator;

class CustomerController extends Controller
{
   

    public function customerlist(){
        $customers=User::userListWithLastOrder();
        return view('backend.customer.customerlist',compact('customers'));
    }
    public function addcustomer(){
        $customertypes=Customertype::latest()->get();
        return view('backend.customer.addcustomer',compact('customertypes'));
    }
    public function storecustomer(Request $request){
        $validateData=$request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'status' => 'required',
                'password' => 'confirmed',
            ], 
            [
                'name.required'=>'Please enter customer name',
                'email.required'=>'Please enter customer email'
            ]
        );
        
        if(!isset($request['new_password']) || $request['new_password']==''){
            $password=Hash::make('customer123$');
        }
        else{
            $password=Hash::make($request['new_password']);
        }
        if($request['customertype']!=''){
            $customertype=$request['customertype'];
        }
        else{
            $customertype=NULL;
        }
        if($request['discount']!=''){
            $discount=$request['discount'];
        }
        else{
            $discount=NULL;
        }
        if($request['status']!=''){
            $status=$request['status'];
        }
        else{
            $status=0;
        }
        User::insert([
            'email' => $request['email'],
            'name' => $request['name'],
            'customerno' => $request['customerno'],
            'phoneno' => $request['phoneno'],
            'company' => $request['company'],
            'customertype' => $customertype,
            'status' => $status,
            'bill_address1' => $request['bill_address1'],
            'bill_address2' => $request['bill_address2'],
            'bill_city' => $request['bill_city'],
            'bill_state' => $request['bill_state'],
            'bill_zipcode' => $request['bill_zipcode'],
            'ship_address1' => $request['ship_address1'],
            'ship_address2' => $request['ship_address2'],
            'ship_city' => $request['ship_city'],
            'ship_state' => $request['ship_state'],
            'ship_zipcode' => $request['ship_zipcode'],
            'password' => $password,
        ]);
        
        $notification = array(
          'message'=> 'Customer added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allcustomers')->with($notification);
    }
    public function updatecustomer(Request $request){
        $customerid=$request->id;
        $validateData=$request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$customerid.',id',
                'status' => 'required',
                'password' => 'confirmed',
            ], 
            [
                'name.required'=>'Please enter customer name',
                'email.required'=>'Please enter customer email'
            ]
        );
        if(isset($request['new_password']) && !empty($request['new_password'])){
           // $password=Hash::make('customer123$');
            User::findorfail($customerid)->update([
                'password' => Hash::make($request['new_password']),
            ]);
        }
        else{
            //$password=Hash::make($request['new_password']);
           
        }
        
        if($request['customertype']!=''){
            $customertype=$request['customertype'];
        }
        else{
            $customertype=NULL;
        }
       
        if($request['discount']!=''){
            $discount=$request['discount'];
        }
        else{
            $discount=NULL;
        }
        if($request['status']!=''){
            $status=$request['status'];
        }
        else{
            $status=0;
        }
        User::findorfail($customerid)->update([
            'email' => $request['email'],
            'name' => $request['name'],
            'customerno' => $request['customerno'],
            'phoneno' => $request['phoneno'],
            'company' => $request['company'],
            'customertype' => $customertype,
            'status' => $status,
            'bill_address1' => $request['bill_address1'],
            'bill_address2' => $request['bill_address2'],
            'bill_city' => $request['bill_city'],
            'bill_state' => $request['bill_state'],
            'bill_zipcode' => $request['bill_zipcode'],
            'ship_address1' => $request['ship_address1'],
            'ship_address2' => $request['ship_address2'],
            'ship_city' => $request['ship_city'],
            'ship_state' => $request['ship_state'],
            'ship_zipcode' => $request['ship_zipcode'],
           // 'password' => $password,
        ]);
        
        $notification = array(
          'message'=> 'Customer updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcustomers')->with($notification);
    }
    public function deletecustomer($id){
        
        User::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'Customer deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcustomers')->with($notification);
    }
    public function editcustomer($id){
        $customerdetails= User::findorfail($id);
        $customertypes=Customertype::latest()->get();
        return view('backend.customer.editcustomer',compact('customerdetails','customertypes'));
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
    
    public function customerimport(){
        return view('backend.customer.importcustomer');
    }
    public function customerimportprocess(Request $request)
    {
        //$file = public_path('file/test.csv');
        $this->validate(request(), [
            'customercsv' => ['required',function ($attribute, $value, $fail) {
                if (!in_array($value->getClientOriginalExtension(), ['csv'])) {
                    $fail('Incorrect File Format.');
                }
            }]
        ]);
        
       $file = $request->file('customercsv');
        $filename = 'cif'.hexdec(uniqid()).'.'.request()->customercsv->getClientOriginalExtension();
         $request->customercsv->storeAs('uploads/files',$filename,'public');
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
        for ($i = 0; $i < count($customerArr); $i ++)
        {
            $users = User::where('email', '=', $customerArr[$i]['Email'])->first();
            if ($users === null) {
                $data[] = [
                  'name' => $customerArr[$i]['Name'],
                  'email' => $customerArr[$i]['Email'],
                  'password' => Hash::make($customerArr[$i]['Password']),
              ];
            }
            
            //User::firstOrCreate($customerArr[$i]);
        }
        //print_r($data);
       // exit;
        DB::table('users')->insert($data);
         $notification = array(
          'message'=> 'Customers added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
    }
    
    public function customerpricing($id){
        $customerdetails= User::findorfail($id);
        $customertypes=Customertype::latest()->get();
        $customerpricing=Customerpricing::where('customerid',$id)->get();
        $products=Product::latest()->get();
        return view('backend.customer.customerpricing',compact('customerdetails','customertypes','products','customerpricing'));
    }
    public function updatecustomerpricing($id,Request $request){
        Customerpricing::where('customerid', $request['cid'])->delete();
        foreach ($request['price'] as $key =>$value) {
            //echo $key.' -'.$value;
            if($value!=''){
                
                Customerpricing::insert([
                    'productid' => $key,
                    'customerid' => $request['cid'],
                    'price'=>$value, 
                    'discountprice'=>$request['discountprice'][$key],
                ]);
            }
        }
        $notification = array(
          'message'=> 'Customers Price Updated Successfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
    }
    
    
    public function customerpricingimport(){
        $customers=User::orderBy('name')->get();
        return view('backend.customer.importproductprice',compact('customers'));
    }
    public function customerpricingimportprocess(Request $request)
    {
        //$file = public_path('file/test.csv');
        $this->validate(request(), [
            'productpricingcsv' => ['required',function ($attribute, $value, $fail) {
                if (!in_array($value->getClientOriginalExtension(), ['csv'])) {
                    $fail('Incorrect File Format.');
                }
            }],
            'customerid' => ['required'],     
        ]);
        $customerid=$request->customerid;
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
                           
                            $user = Customerpricing::updateOrCreate(
                                [
                                    'productid'    => $customerArr[$i]['id'],
                                    'customerid'  => $customerid,
                                ], 
                                [
                                    'price'=>$customerArr[$i]['price'],
                                    'discountprice'=>$discount
                            ]);
                        }
                        else{
                             $user = Customerpricing::updateOrCreate(
                                [
                                    'productid'    => $customerArr[$i]['id'],
                                    'customerid'  => $customerid,
                                ], 
                                [
                                    'price'=>$customerArr[$i]['price'], 
                            ]);
                        }
                    }    
                    else{
                          $user = Customerpricing::updateOrCreate(
                                [
                                    'productid'    => $customerArr[$i]['id'],
                                    'customerid'  => $customerid,
                                ], 
                                [
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
