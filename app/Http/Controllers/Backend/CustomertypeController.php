<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customertype;
class CustomertypeController extends Controller
{
    public function customertypelist(){
        $customertypes=Customertype::latest()->get();
        return view('backend.customertype.customertypelist',compact('customertypes'));
    }
    public function addcustomertype(Request $request){
        $validateData=$request->validate(
            [
                'ctname'=>'required',
                'description'=>'required',
            ],
            [
                'ctname.required'=>'Please enter customertype name',
                'description.required'=>'Please enter customertype details'
            ]
        );
        
        Customertype::insert([
          'ctname'=>$request->ctname,
          'description'=>$request->description 
        ]);
        
        $notification = array(
          'message'=> 'Customertype added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allcustomertypes')->with($notification);
    }
    public function updatecustomertype(Request $request){
        $customertypeid=$request->id;
        $validateData=$request->validate(
            [
                'ctname'=>'required',
                'description'=>'required',
            ],
            [
                'ctname.required'=>'Please enter customertype name',
                'description.required'=>'Please enter customertype details'
            ]
        );
        
        Customertype::findorfail($customertypeid)->update([
          'ctname'=>$request->ctname,
          'description'=>$request->description 
        ]);
        
        $notification = array(
          'message'=> 'Customertype updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcustomertypes')->with($notification);
    }
    public function deletecustomertype($id){
        
        Customertype::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'Customertype deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcustomertypes')->with($notification);
    }
    public function editcustomertype($id){
        $customertype= Customertype::findorfail($id);
        return view('backend.customertype.editcustomertype',compact('customertype'));
    }
}
