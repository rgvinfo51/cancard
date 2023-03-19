<?php

namespace App\Http\Controllers\Frontend;

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
use Mail;
use Validator;
use App\Models\OrderPayment;
use App\Models\PaymentSetting;
use App\Models\Address;
use App\Models\POupload;

class UserController extends Controller
{
      protected function validator(array $data)
    {
        return Validator::make($data, [
            'phoneno' => 'required|phone',
            'customer_id' => 'required',
            'company' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:10|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ],
        [
            'password.regex' => 'The password must be at least 10 characters and contain at least one uppercase character, one number, and one special character.',
            'posttitle.required' => 'The Title field is required.',
        ]);
    }
    protected function create(array $data)
    {
        $pass = Hash::make(trim($data['password']));
        return User::create([
                'customer_id' => $data['customer_id'],
                'name' => $data['name'],
                'phoneno' => $data['phoneno'],
                'company' => $data['company'],
                'posttitle' => $data['posttitle'],
                'bill_address1' => ($data['bill_address1']) ?? '',
                'corporateaddress' => ($data['bill_address1']) ?? '',
                'email' => $data['email'],
                //'password' => bcrypt($data['password']),
                'password' => $pass,
                'status' => '0',
            ]);
    }
    
    public function myorders(Request $request)  {
            /*  $details=[
                    'customer_id' => "asdasdsaa",                        
                    'name' => "asdasdsaa", 
                    'email' => "surraj8707@gmail.com", 
                    'phoneno' => "asdasdsaa",
                    'company' => "asdasdsaa",
                    'posttitle' => "asdasdsaa",
                    'sendtocustomer' => 0,
                    'corporateaddress' => "asdasdsaa",
                 ];
                Mail::to("rgv.info51@gmail.com")->send(new \App\Mail\RegisterMail($details));


                die;
            */
           
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
          else{
              return redirect()->route('login');
          }

          if(!empty($request->has('search_order'))){
            
            $orderlist = Order::where(function ($query) use ($user) {
                        $query->where('user_id', '=', $user->id)
                        ->orWhere('email','=', $user->email);
            })->where(function ($query) use ($request) {
                        $query->where('orderno', '=', (substr($request->search_order,0,1)=="#") ? $request->search_order : "#".$request->search_order)
                        ->orWhere('purchaseno','=', $request->search_order);
            })
            ->get();
          }
          else{
            $orderlist=Order::where('user_id',$userid)->orWhere('email',$user->email)->orderBy('created_at','DESC')->get();
          }
          
        $orderitems=array();
    
        return view('frontend.myaccount.orders',compact('orderlist'));
    }

    public function orderdetail(Request $request, $id)  {
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
          else{
              return redirect()->route('login');
          }
        $order=Order::findOrFail($id);
        $order =DB::table('orders')->Where('id','=',$id)->first();
        
        $orderitems=array();
        //orderlist=array();
        if($order){
            $orderids=array();
              $orderitems =DB::table('order_items')
                ->join('products','order_items.productid', '=', 'products.id')
                ->Where('order_items.order_id',$id)
                ->select('products.id','products.slug','products.productname','products.productimage','order_items.*')
                ->get();
              
        }
        $orderpaymentdetail=array();
        
        if($order->payment_id!=NULL){
            $orderpaymentdetail=OrderPayment::find($order->payment_id);
        }
        return view('frontend.myaccount.orderdetail',compact('order','orderitems','orderpaymentdetail'));
    }

    public function invoice($id){
         // echo "<pre>";
         $order =Order::select('orders.*', 'users.name')
                    ->join('users', 'users.id', '=', 'orders.user_id')
                    ->with('order_items')->where('orders.id',$id)->first()->toArray();
        // print_r($order);
        // die;
        return view('frontend.myaccount.invoice',compact('order'));
    }
    public function myquotes()  {
          if(Auth::check()){
              $user = Auth::user();
              $userid=$user->id;
          }
          else{
              return redirect()->route('login');
          }
        $quotelist=Quote::where('email',$user->email)->orderBy('created_at','DESC')->get();
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
        return view('frontend.myaccount.myquotes',compact('quotelist','quoteitems'));
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
        return view('frontend.myaccount.myquotedetail',compact('quote','quoteitems'));
    }
    public function subscribe(Request $request)  {   
        $messages = array(
                'email.unique' => 'You have already subscribed for our newsletter'
            );
        $validation = Validator::make($request->all(), [
                            'email' => 'required|email|unique:newsletter',
                        ],$messages);
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
        else{
            //$user = $this->create($request->all());
            //$credentials = $request->only('email', 'password');
            $email=$request->email;
            DB::table('newsletter')->insert(
                    array(
                           'status'     =>   '1', 
                           'email'   =>   $email
                    )
               );
            return response()->json(['success' => 'Thank you for subscribing for our newsletter']);
        }
    }
    public function register(Request $request)  {
        
        $customer_id = "CI".rand(100,999999999);
        request()->request->add(['customer_id'=>$customer_id]);

        $validation = $this->validator($request->all());
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
        else{
            $user = $this->create($request->all());
            $credentials = $request->only('email', 'password');
            if($user)
            {
                try {
                    $details=[
                            'customer_id' => $request->customer_id,                        
                            'name' => $request->name, 
                            'email' => $user->email, 
                            'phoneno' => $user->phoneno,
                            'company' => $user->company,
                            'posttitle' => $user->posttitle,
                            'sendtocustomer' => 0,
                            'corporateaddress' => $user->corporateaddress,
                         ];
                        Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\RegisterMail($details));
                        $details=[
                            'customer_id' => $request->customer_id,                            
                            'name' => $request->name, 
                            'email' => $user->email, 
                            'phoneno' => $user->phoneno,
                            'company' => $user->company,
                            'posttitle' => $user->posttitle,
                            'corporateaddress' => $user->corporateaddress,
                            'sendtocustomer' => 1,
                         ];
                        Mail::to($request->email)->send(new \App\Mail\RegisterMail($details));

                    } catch (Exception $ex) {
                        // Debug via $ex->getMessage();
                       // $messagetype="alerterror";
                      // $message="Something went wrong. Please try again";
                         return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
                    }
                return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
            } 
           /* if (Auth::attempt($credentials)) {
                 //return response()->json(['success' => 'Registration succesfull','redirecturl'=>route('dashboard')]);
                 return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
            }*/
            return response()->json(['errors' => 'Something is wrong.Please try again']);
        }
    }

    public function ajaxlogin(Request $request)  {

        // return $request->all();
        //$validation = $this->validator($request->all());
        $validation = Validator::make($request->all(), [
                            'email' => 'required',
                            'password' => 'required',
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
        else{

            $customerdata=User::where('email',$request->email)->orWhere('customer_id',$request->email)->first();
            if($customerdata){

                if($customerdata->status==1){
                    //$user = $this->create($request->all());
                    //$credentials = $request->only('email', 'password');
                    $email=$request->email;
                    $password=$request->password;
                    if (Auth::attempt(['email' => $email, 'password' => $password]) or Auth::attempt(['customer_id' => $email, 'password' => $password])) {
                                             
                         return response()->json(['success' => 'Login succesfull','redirecturl'=>route('orders')]);
                    }
                    return response()->json(['errors' => 'User email and password does not match']);
                }else{
                    return response()->json(['errors' => 'Your account is inactive. Please contact us for further query']);
                }
            }
            else{
                return response()->json(['errors' => 'User email and password does not match']);
            }
        }
    }
     public function customregister(Request $request)  {
        $customer_id = "CI".rand(100,999999999);
        request()->request->add(['customer_id'=>$customer_id]);
        $validation = $this->validator($request->all());
        $request->validate([
            'customer_id' => 'required',
            'phoneno' => 'required|phone',
            //'posttitle' => 'required',
            'company' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:10|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ],
        [
            'password.regex' => 'The password must be at least 10 characters and contain at least one uppercase character, one number, and one special character.',
            'posttitle.required' => 'The Title field is required.',
        ]
            );
       
            // return $request->all();
            $user = $this->create($request->all());
            $credentials = $request->only('email', 'password');
            if($user)
            {
                try {
                    $details=[
                            'customer_id' => $request->customer_id, 
                            'name' => $request->name, 
                            'email' => $user->email, 
                            'phoneno' => $user->phoneno,
                            'company' => $user->company,
                            'posttitle' => $user->posttitle,
                            'sendtocustomer' => 0,
                            'corporateaddress' => $user->corporateaddress,
                         ];
                        Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\RegisterMail($details));
                        $details=[
                            'customer_id' => $request->customer_id, 
                            'name' => $request->name, 
                            'email' => $user->email, 
                            'phoneno' => $user->phoneno,
                            'company' => $user->company,
                            'posttitle' => $user->posttitle,
                            'corporateaddress' => $user->corporateaddress,
                            'sendtocustomer' => 1,
                         ];
                        Mail::to($request->email)->send(new \App\Mail\RegisterMail($details));

                    } catch (Exception $ex) {
                        // Debug via $ex->getMessage();
                       // $messagetype="alerterror";
                      // $message="Something went wrong. Please try again";
                     //return back()->withErrors('Something is wrong.Please try again');
                        return redirect()->route('login')->with('success', "Registration succesfull. Once we approve you can login and check our products");
                        //return Redirect::to('/login')->with('success', "Registration succesfull. Once we approve you can login and check our products");
                    }
               return redirect()->route('login')->with('success', "Registration succesfull. Once we approve you can login and check our products");
               // return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
            } 
           /* if (Auth::attempt($credentials)) {
                 //return response()->json(['success' => 'Registration succesfull','redirecturl'=>route('dashboard')]);
                 return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
            }*/
             return back()->withErrors('Something is wrong.Please try again');
    }
    public function customlogin(Request $request)  {   
        //$validation = $this->validator($request->all());
        $validation = Validator::make($request->all(), [
                            'email' => 'required',
                            'password' => 'required',
                        ]);
         $request->validate([
            'email' => 'required',
            'password' => 'required',
            ],
            [
                'email.required' => 'Email Required',
                'password.required' => 'Password Required',
                //'posttitle.required' => 'Title Required'
            ]
            );
        
            $customerdata=User::where('email',$request->email)->orWhere('customer_id',$request->email)->first();
            if($customerdata){
                if($customerdata->status==1){
                    //$user = $this->create($request->all());
                    //$credentials = $request->only('email', 'password');
                    $email=$request->email;
                    $password=$request->password;
                    if(Hash::check($request->password, $customerdata->password)) {
                        Auth::login($customerdata);
                        return redirect()->intended('orders');
                    }
                    /*if (Auth::attempt(['email' => $email, 'password' => $password])) {
                         //return response()->json(['success' => 'Login succesfull','redirecturl'=>route('dashboard')]);
                         return redirect()->route('dashboard');
                    }*/
                    return back()->withErrors('User email and password does not match');
                }else{
                     return back()->withErrors('Your account is inactive. Please contact us for further query');
                }
            }
            else{
              
                 return back()->withErrors('User email and password does not match');
            }
    }
    public function CustomerProfile(){
        $customerdata = Auth::user();
        return view('frontend.myaccount.profile',compact('customerdata'));
    }
    public function CustomerProfileUpdate(Request $request){
        $userid = Auth::user()->id;
        $customerdata=User::find($userid);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'posttitle' => ['required', 'string'],
            'company' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email'],
            'officeno' => ['required', 'phone'],
            'phoneno' => ['required', 'phone'],
            'corporateaddress' => ['required', 'string'],
            'city' => ['required', 'string'],
            'country' => ['required', 'string'],
            'province' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
           //'posttitle' => ['required', 'string', 'max:255'],
            ],
            [
                'name.required' => 'Name Required',
                'posttitle.required' => 'Title/Role Required',
                'company.required' => 'Company Name Required',
                //'email.required' => 'Email Required',
                'officeno.required' => 'Office Phone Required', 
                'phoneno.required' => 'Phone No Required',
                
                'corporateaddress.required' => 'Address Line 1 Required',
                'city.required' => 'City Required',
                'country.required' => 'Country Required',
                'province.required' => 'Province/State Required',
                'zipcode.required' => 'Zipcode/Postal Code Required',
            ]
            );
        

        if($request->old_password!=''){
            
            $this->validate($request, [
                'old_password'     => 'required',
                'new_password'     => [
                                        'required',
                                        'string',
                                        'min:10',             // must be at least 10 characters in length
                                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                        'regex:/[0-9]/',      // must contain at least one digit
                                        'regex:/[@$!%*#?&]/', // must contain a special character
                                    ],
                'confirm_password' => 'required|same:new_password',
            ],
            [
                'new_password.regex' => 'Password must contain least 10 characters,1 Lower case,1 Upper case,1 Digit & 1 Special Character',
                //'posttitle.required' => 'Title Required'
            ]
            );
            if (!Hash::check($request->old_password,$customerdata->password)) {
                return back()->with('error', 'The current password is invalid');
            }
            else{
                $customerdata->password = Hash::make($request->new_password);
            }
        }

        
        $customerdata->name=$request->name;
       // $customerdata->email=$request->email;
        $customerdata->phoneno=$request->phoneno;
        $customerdata->posttitle=$request->posttitle;
        $customerdata->company=$request->company;
        $customerdata->corporateaddress=$request->corporateaddress;
        $customerdata->office_no=$request->officeno;
        $customerdata->alt_email=$request->alt_email;
        $customerdata->address2=$request->address2;
        $customerdata->city=$request->city;
        $customerdata->country=$request->country;
        $customerdata->province=$request->province;
        $customerdata->zipcode=$request->zipcode;
        $customerdata->save();
        $customerdata = Auth::user();
        
        $notification=array(
            'message'=>"Customer Information Updated Successfully",
            'action'=>'success'
        );
        return redirect()->route('profile',compact($customerdata))->with($notification);
    }
    public function CustomerAddress(){
        $customerdata = Auth::user();
        $billingaddress=1;
        $shippingaddress=1;
        $addresses = Address::where('user_id',$customerdata->id)->orderBy('set_default','desc')->get()->toArray();
        // echo("<pre>");
        // echo $customerdata->id;
        // print_r($addresses);
        // die;
        if($customerdata->bill_firstname=='' && $customerdata->bill_lastname==''){
            $billingaddress=0;
        }

        if($customerdata->ship_firstname=='' && $customerdata->ship_lastname==''){
            $shippingaddress=0;
        }
        return view('frontend.myaccount.addresses',compact('customerdata','shippingaddress','billingaddress','addresses'));
    }
    public function CustomerBillingAddress(){
        $customerdata = Auth::user();
        return view('frontend.myaccount.billingaddress',compact('customerdata'));
    }
    public function CustomerBillingAddressUpdate(Request $request){
        $userid = Auth::user()->id;
        $customerdata=User::find($userid);
        $request->validate([
            'bill_firstname' => ['required', 'string', 'max:255'],
            'bill_lastname' => ['required', 'string', 'max:255'],
            'bill_address1' => ['required', 'string', 'max:255'],
            'bill_city' => ['required', 'string', 'max:255'],
            'bill_zipcode' => ['required', 'string', 'max:255'],
            'bill_country' => ['required', 'string', 'max:255'],
            ],
            [
            'bill_firstname.required' => 'Frist Name Required',
            'bill_lastname.required' => 'Last Name Required',
            'bill_address1.required' => 'Street Address Required',
            'bill_city.required' => 'City Required',
            'bill_zipcode.required' => 'Postal Code Required',
            'bill_country.required' => 'Country Required',
            ]
            );
        $customerdata->bill_firstname=$request->bill_firstname;
        $customerdata->bill_lastname=$request->bill_lastname;
        $customerdata->bill_address1=$request->bill_address1;
        $customerdata->bill_address2=$request->bill_address2;
        $customerdata->bill_city=$request->bill_city;
        $customerdata->bill_zipcode=$request->bill_zipcode;
        $customerdata->bill_country=$request->bill_country;
        $customerdata->bill_state=$request->bill_state;
        $customerdata->save();
        $customerdata = Auth::user();
        
        $notification=array(
            'message'=>"Address Information Updated Successfully",
            'action'=>'success'
        );
        return redirect()->route('billingaddress.update',compact($customerdata))->with($notification);
    }

    public function CustomerMoreAddress(Request $request){
        $address = new Address;
        $address->user_id = $request->user_id;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->province = $request->province;
        $address->zipcode = $request->zipcode;
        $address->save();
        return redirect()->back()->with('message','New Address Added Successfully');
    }

    public function AddShippingCustomerMoreAddress(){
        $customerdata = Auth::user();
        echo view('frontend.myaccount.addaddresses',compact('customerdata'))->render();
    }

    public function editCustomerMoreAddress(){
        $id = $_REQUEST['id'];
        $address = Address::find($id)->toArray();
        echo view('frontend.myaccount.editaddresses',compact('address'))->render();
    }

    public function updateCustomerMoreAddress(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $address = Address::find($request->user_id);
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->city = $request->city;
        $address->country = $request->country;
        $address->province = $request->province;
        $address->zipcode = $request->zipcode;
        $address->save();
        return redirect()->route('addresses')->with('message','Address Updated Successfully');
    }

    public function deleteCustomerMoreAddress($id){
        $address = Address::where('id',$id)->delete();
        return redirect()->back()->with('message','Address Deleted Successfully');
    }
    public function CustomerShippingAddress(){
        $customerdata = Auth::user();
        return view('frontend.myaccount.shippingaddress',compact('customerdata'));
    }
    public function CustomerShippingAddressUpdate(Request $request){
        $userid = Auth::user()->id;
        $customerdata=User::find($userid);
        $request->validate([
            'ship_firstname' => ['required', 'string', 'max:255'],
            'ship_lastname' => ['required', 'string', 'max:255'],
            'ship_address1' => ['required', 'string', 'max:255'],
            'ship_city' => ['required', 'string', 'max:255'],
            'ship_zipcode' => ['required', 'string', 'max:255'],
            'ship_country' => ['required', 'string', 'max:255'],
            ],
            [
            'ship_firstname.required' => 'Frist Name Required',
            'ship_lastname.required' => 'Last Name Required',
            'ship_address1.required' => 'Street Address Required',
            'ship_city.required' => 'City Required',
            'ship_zipcode.required' => 'Postal Code Required',
            'ship_country.required' => 'Country Required',
            ]
            );
        $customerdata->ship_firstname=$request->ship_firstname;
        $customerdata->ship_lastname=$request->ship_lastname;
        $customerdata->ship_address1=$request->ship_address1;
        $customerdata->ship_address2=$request->ship_address2;
        $customerdata->ship_city=$request->ship_city;
        $customerdata->ship_zipcode=$request->ship_zipcode;
        $customerdata->ship_country=$request->ship_country;
        $customerdata->save();
        $customerdata = Auth::user();

        // Insert Address Table
        $address = new Address;
        $address->user_id = $customerdata->id;
        $address->address1 = $request->ship_address1;
        $address->address2 = $request->ship_address2;
        $address->city = $request->ship_city;
        $address->zipcode = $request->ship_zipcode;
        $address->country = $request->ship_country;
        $address->province = $request->province;
        $address->save();
        
        $notification=array(
            'message'=>"Address Information Updated Successfully",
            'action'=>'success'
        );
        return redirect()->route('shippingaddress.update',compact($customerdata))->with($notification);
    }
    
    public function security(){
        $customerdata = Auth::user();
        return view('frontend.myaccount.security',compact('customerdata'));
    }
    
    public function updatePassword(Request $request){
        $request->validate([
            'new_password' => 'required_with:confirm_password|same:confirm_password|min:10|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'confirm_password' => 'required|min:10|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ],
        [
            'new_password.regex' => 'The password must be at least 10 characters and contain at least one uppercase character, one number, and one special character.',
            'confirm_password.regex' => 'The password must be at least 10 characters and contain at least one uppercase character, one number, and one special character.',
        ]
            );
        $user = User::find($request->user_id);
        if(!empty($user)){
            if(Hash::check($request['current_password'], $user->password)){
                $user->password = Hash::make(trim($request['new_password']));
                $user->save();
                return redirect()->route('user.logout')->with('message','Password Changed Successfully');
            }
            else{
                return redirect()->back()->with('message','You have enter the wrong password');
            }
        }
        else{
            return redirect()->back()->with('message','User Not Found');
        }
    }
    
    public function paymentsetting(){
        $customerdata = Auth::user();
        $paymentsetting = PaymentSetting::where('user_id',$customerdata->id)->orderBy('id','desc')->get();
        return view('frontend.myaccount.payment_setting',compact('customerdata','paymentsetting'));
    }

    public function addpaymentsetting(Request $request){

        $is_default = ($request->set_default==1) ? 1 : 0;

        if($request->set_default==1){
            $affected = DB::table('payment_setting')->update(array('set_default' => 0));
        }

        $payment = new PaymentSetting;
        $payment->user_id = $request->input('user_id');
        $payment->name = $request->input('name');
        $payment->card_number = $request->input('card_number');
        $payment->cvv = $request->input('cvv');
        $payment->expiration_month = $request->input('expiration_month');
        $payment->expiration_year = $request->input('expiration_year');
        $payment->set_default = $is_default;
        $payment->save();
        return redirect()->back()->with('message','Payment Details Added Successfully');

    }

    public function editpayment($id){
        $paymentsetting = PaymentSetting::where('id',$id)->first();
        // return redirect()->back()->with('message','Payment Details Deleted Successfully');
        return view('frontend.myaccount.payment_edit',compact('paymentsetting'));

    }

    public function updatepayment(Request $request){
        $is_default = ($request->set_default==1) ? 1 : 0;

        if($request->set_default==1){
            $affected = DB::table('payment_setting')->update(array('set_default' => 0));
        }

        $payment = PaymentSetting::find($request->id);
        $payment->name = $request->name;
        $payment->card_number = $request->card_number;
        $payment->cvv = $request->cvv;
        $payment->expiration_month = $request->expiration_month;
        $payment->expiration_year = $request->expiration_year;
        $payment->set_default = $is_default;
        $payment->save();
        return redirect()->route('paymentsetting')->with('message','Payment Details Updated Successfully');

    }

    public function deletepayment($id){
        $student = PaymentSetting::where('id',$id)->delete();
        return redirect()->back()->with('message','Payment Details Deleted Successfully');

    }

    public function setDefaultCustomerAddress($id){
        $user = Auth::user();
        $userid=$user->id;
        $affected = DB::table('addresses')->where('user_id',$userid)->update(array('set_default' => 0));
        $affected = DB::table('addresses')->where('id',$id)->update(array('set_default' => 1));
        return redirect()->back()->with('message','Address Set Default Successfully');

    }

    public function uploadPo(Request $request){
        $user = Auth::user();
        $userid=$user->id;
        // $fileName = time().'.'.$request->po_file->extension();             
        // $request->po_file->move(public_path('frontend/po_uploads'), $fileName);

        $purchasedoc=null;
        if($request->hasFile('po_file')) {
            $purchasedoc = 'ci'.hexdec(uniqid()).'.'.request()->po_file->getClientOriginalExtension();
            $request->po_file->storeAs('uploads/orders/',$purchasedoc,'public');
        }

        $PO = new POUpload();
        $PO->user_id = $userid;
        $PO->pdf = $purchasedoc;
        $PO->status = 0;
        $PO->save();

        /*try {
            $details=[
                    'customer_id' => $request->customer_id,                        
                    'name' => $request->name, 
                    'email' => $user->email, 
                    'phoneno' => $user->phoneno,
                    'company' => $user->company,
                    'posttitle' => $user->posttitle,
                    'sendtocustomer' => 0,
                    'corporateaddress' => $user->corporateaddress,
                 ];
                Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\RegisterMail($details));
                $details=[
                    'customer_id' => $request->customer_id,                            
                    'name' => $request->name, 
                    'email' => $user->email, 
                    'phoneno' => $user->phoneno,
                    'company' => $user->company,
                    'posttitle' => $user->posttitle,
                    'corporateaddress' => $user->corporateaddress,
                    'sendtocustomer' => 1,
                 ];
                Mail::to($request->email)->send(new \App\Mail\RegisterMail($details));

            } catch (Exception $ex) {
                 return response()->json(['success' => 'Registration succesfull. Once we approve you can login and check our products']);
            }*/

        return redirect()->back()->with('success_message','PO Updated Successfully');
    }
    
}
