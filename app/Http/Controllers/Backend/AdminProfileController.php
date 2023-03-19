<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class AdminProfileController extends Controller
{
    public function AdminProfile(){
        //$adminid = Auth::user()->id;
        //$admindata=Admin::find($adminid);
        $admindata = auth()->user();
        return view('admin.profile',compact($admindata));
    }
    public function AdminProfileUpdate(Request $request){
        $adminid = Auth::user()->id;
        $admindata=Admin::find($adminid);
        $admindata->name=$request->name;
        $admindata->email=$request->email;
        $admindata->save();
        $admindata = auth()->user();
        
        $notification=array(
            'message'=>"Admin Information Updated Successfully",
            'action'=>'success'
        );
        return redirect()->route('admin.profile',compact($admindata))->with($notification);
    }
    public function AdminPasswordUpdate(Request $request){
        
        $validateData=$request->validate([
            'currentpassword'=>'required',
            'password'=>'required|confirmed',
        ]);
        
        $adminid = Auth::user()->id;
        $admindata=Admin::find($adminid);
        
        $hashedpassword=$admindata->password;
        if(Hash::check($request->currentpassword,$hashedpassword)){
            $admindata->password=Hash::make($request->password);
            $admindata->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }
        else{
            $notification=array(
            'message'=>"Password is incorrect",
                'action'=>'error'
            );
            return redirect()->back()->with($notification);
        }
        
        return redirect()->route('admin.profile',compact($admindata))->with($notification);
    }
}
