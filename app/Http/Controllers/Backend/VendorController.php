<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    //
    public function vendorlist(){
        $vendors=Vendor::latest()->get();
        return view('backend.vendor.vendorlist',compact('vendors'));
    }
    public function addvendor(Request $request){
        $validateData=$request->validate(
            [
                'vendorname'=>'required',
                'vendorinfo'=>'required',
            ],
            [
                'vendorname.required'=>'Please enter vendor name',
                'vendorinfo.required'=>'Please enter vendor details'
            ]
        );
        
        Vendor::insert([
          'vendorname'=>$request->vendorname,
          'vendorinfo'=>$request->vendorinfo 
        ]);
        
        $notification = array(
          'message'=> 'Vendor added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allvendors')->with($notification);
    }
    public function updatevendor(Request $request){
        $vendorid=$request->id;
        $validateData=$request->validate(
            [
                'vendorname'=>'required',
                'vendorinfo'=>'required',
            ],
            [
                'vendorname.required'=>'Please enter vendor name',
                'vendorinfo.required'=>'Please enter vendor details'
            ]
        );
        
        Vendor::findorfail($vendorid)->update([
          'vendorname'=>$request->vendorname,
          'vendorinfo'=>$request->vendorinfo 
        ]);
        
        $notification = array(
          'message'=> 'Vendor updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allvendors')->with($notification);
    }
    public function deletevendor($id){
        
        Vendor::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'Vendor deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allvendors')->with($notification);
    }
    public function editvendor($id){
        $vendor= Vendor::findorfail($id);
        return view('backend.vendor.editvendor',compact('vendor'));
    }
}
