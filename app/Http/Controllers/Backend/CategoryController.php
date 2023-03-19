<?php

namespace App\Http\Controllers\Backend;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function categorylist(){
        $categories=Category::latest()->get();
        return view('backend.category.categorylist',compact('categories'));
    }
    public function addcategory(){
        $categories=Category::orderBy('name', 'ASC')->get();
        $applications=Application::latest()->get();
        return view('backend.category.addcategory',compact('categories','applications'));
    }
    public function insertcategory(Request $request){
        $validateData=$request->validate(
            [
                'name'=>'required',
                'status'=>'required',
                'slug'=>'required',
            ],
            [
                'name.required'=>'Please enter category name',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter category slug'
            ]
        );
        $categoryimageName='';
         if($request->hasFile('categoryimage')) {
            $categoryimageName = 'ci'.hexdec(uniqid()).'.'.request()->categoryimage->getClientOriginalExtension();
            $request->categoryimage->storeAs('uploads/category',$categoryimageName,'public');
        }
        $bannerimageName='';
         if($request->hasFile('banner')) {
            $bannerimageName = 'ci'.hexdec(uniqid()).'.'.request()->banner->getClientOriginalExtension();
            $request->banner->storeAs('uploads/categorybanner',$bannerimageName,'public');
        }
        $applications='';
        if(isset($request['applications'])){
            $applications=implode(",",$request['applications']);
        }
        Category::insert([
          'name'=>$request->name,
          'slug'=>$request->slug, 
          'status'=>$request->status,
          'description'=>$request->description,
          'shortdescription'=>$request->shortdescription,
          'categoryimage'=>$categoryimageName, 
          'banner'=>$bannerimageName, 
          'parentid'=>$request->parentid, 
          'applications'=>$applications,
          'sortorder'=>$request->sortorder 
        ]);
        
        $notification = array(
          'message'=> 'Category added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allcategory')->with($notification);
    }
    public function updatecategory(Request $request){
        $categoryid=$request->id;
        $oldimage=$request->oldimage;
        $oldbanner=$request->oldbanner;
        $validateData=$request->validate(
            [
                'name'=>'required',
                'status'=>'required',
                'slug'=>'required',
            ],
            [
                'name.required'=>'Please enter category name',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter category slug'
            ]
        );
        
        $categoryimageName=$oldimage;
         if($request->hasFile('categoryimage')) {
             Storage::disk('public')->delete('/uploads/category/' . $oldimage);
            $categoryimageName = 'ci'.hexdec(uniqid()).'.'.request()->categoryimage->getClientOriginalExtension();
            $request->categoryimage->storeAs('uploads/category',$categoryimageName,'public');
        }
        $bannerimageName=$oldbanner;
         if($request->hasFile('banner')) {
             Storage::disk('public')->delete('/uploads/categorybanner/' . $oldbanner);
            $bannerimageName = 'ci'.hexdec(uniqid()).'.'.request()->banner->getClientOriginalExtension();
            $request->banner->storeAs('uploads/categorybanner',$bannerimageName,'public');
        }
        $applications='';
        if(isset($request['applications'])){
            $applications=implode(",",$request['applications']);
        }
        Category::findorfail($categoryid)->update([
          'name'=>$request->name,
          'slug'=>$request->slug, 
          'status'=>$request->status,
          'description'=>$request->description,
          'shortdescription'=>$request->shortdescription,
          'categoryimage'=>$categoryimageName, 
          'banner'=>$bannerimageName, 
          'categoryimagealttext'=>$request->categoryimagealttext, 
          'banneralttext'=>$request->banneralttext, 
          'parentid'=>$request->parentid, 
          'applications'=>$applications,
          'metatitle'=>$request->metatitle, 
          'metakeywords'=>$request->metakeywords, 
          'metadescription'=>$request->metadescription, 
          'sortorder'=>$request->sortorder 
        ]);
        
        $notification = array(
          'message'=> 'Category updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcategories')->with($notification);
    }
    public function deletecategory($id){
        $category= Category::findorfail($id);
        Storage::disk('public')->delete('/uploads/category/' . $category->categoryimage);
        Storage::disk('public')->delete('/uploads/categorybanner/' . $category->banner);
        Category::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'Category deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
        //return redirect()->route('allcategories')->with($notification);
    }
    public function editcategory($id){
        $category= Category::findorfail($id);
        $allcategories= Category::where('id', '!=', $id)->orderBy('name', 'ASC')->get();
        $applications=Application::latest()->get();
        return view('backend.category.editcategory',compact('category','allcategories','applications'));
    }
    public function checkcategoryslug(Request $request)
    {
        //$slug = str_slug($request->title);
        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
