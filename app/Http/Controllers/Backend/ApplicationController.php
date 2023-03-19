<?php

namespace App\Http\Controllers\Backend;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
class ApplicationController extends Controller
{
    //
    public function applicationlist(){
        $applications=Application::latest()->get();
        return view('backend.application.applicationlist',compact('applications'));
    }
    public function addapplication(Request $request){
        $validateData=$request->validate(
            [
                'applicationname'=>'required',
                'slug'=>'required',
              //  'applicationinfo'=>'required',
            ],
            [
                'applicationname.required'=>'Please enter application name',
               // 'applicationinfo.required'=>'Please enter application details'
            ]
        );
        
        Application::insert([
          'applicationname'=>$request->applicationname,
          'applicationinfo'=>$request->applicationinfo,
          'status'=>$request->status,
          'slug'=>$request->slug 
        ]);
        
        $notification = array(
          'message'=> 'Application added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allapplications')->with($notification);
    }
    public function updateapplication(Request $request){
        $applicationid=$request->id;
        $oldbanner=$request->oldbanner;
        $validateData=$request->validate(
            [
                'applicationname'=>'required',
                //'applicationinfo'=>'required',
                'slug'=>'required',
            ],
            [
                'applicationname.required'=>'Please enter application name',
               // 'applicationinfo.required'=>'Please enter application details'
            ]
        );
        
        $bannerimageName=$oldbanner;
        if($request->hasFile('banner')) {
             Storage::disk('public')->delete('/uploads/applicationbanner/' . $oldbanner);
            $bannerimageName = 'App'.hexdec(uniqid()).'.'.request()->banner->getClientOriginalExtension();
            $request->banner->storeAs('uploads/applicationbanner',$bannerimageName,'public');
        }
        
        Application::findorfail($applicationid)->update([
          'applicationname'=>$request->applicationname,
          'applicationinfo'=>$request->applicationinfo,
          'description'=>$request->description,
          'status'=>$request->status,
          'banner'=>$bannerimageName,
          'banneralttext'=>$request->banneralttext, 
          'metatitle'=>$request->metatitle, 
          'metakeywords'=>$request->metakeywords, 
          'metadescription'=>$request->metadescription, 
            'slug'=>$request->slug 
        ]);
        
        $notification = array(
          'message'=> 'Application updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allapplications')->with($notification);
    }
    public function deleteapplication($id){
        
        $application=Application::findorfail($id);
        Storage::disk('public')->delete('/uploads/applicationbanner/' . $application->banner);
        Application::findorfail($id)->delete();
        $notification = array(
          'message'=> 'Application deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allapplications')->with($notification);
    }
    public function editapplication($id){
        $application= Application::findorfail($id);
        return view('backend.application.editapplication',compact('application'));
    }
    public function checkapplicationslug(Request $request)
    {
        //$slug = str_slug($request->title);
        $slug = SlugService::createSlug(Application::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
