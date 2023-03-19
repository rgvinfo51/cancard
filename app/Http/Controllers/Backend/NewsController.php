<?php

namespace App\Http\Controllers\Backend;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Image;
class NewsController extends Controller
{
    public function newslist(){
        $news=News::latest()->get();
        return view('backend.news.newslist',compact('news'));
    }
    public function addnews(){
        return view('backend.news.addnews');
    }
    public function storenews(Request $request){ 
        $validateData=$request->validate(
            [
                'title'=>'required',
                'status'=>'required',
                'slug'=>'required',
            ],
            [
                'title.required'=>'Please enter news title',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter news slug'
            ]
        );
        $bannerimageName='';
         if($request->hasFile('bannerimage')) {
            $bannerimageName = 'ci'.hexdec(uniqid()).'.'.request()->bannerimage->getClientOriginalExtension();
            $request->bannerimage->storeAs('uploads/news',$bannerimageName,'public');
        }
        
        News::insert([
          'title'=>$request->title,
          'slug'=>$request->slug, 
          'status'=>$request->status,
          'description'=>$request->description,
          'bannerimage'=>$bannerimageName, 
          'created_at' => Carbon::now()
        ]);
        
        $notification = array(
          'message'=> 'News added sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->route('allnews')->with($notification);
    }
    public function updatenews(Request $request){
        $newsid=$request->id;
        $oldimage=$request->oldimage;
        $oldbanner=$request->oldbanner;
        $validateData=$request->validate(
            [
                'title'=>'required',
                'status'=>'required',
                'slug'=>'required',
            ],
            [
                'title.required'=>'Please enter news title',
                'status.required'=>'Please select status',
                'slug.required'=>'Please enter news slug'
            ]
        );
        
        $bannerimageName=$oldimage;
         if($request->hasFile('bannerimage')) {
             Storage::disk('public')->delete('/uploads/news/' . $oldimage);
            $bannerimageName = 'ci'.hexdec(uniqid()).'.'.request()->bannerimage->getClientOriginalExtension();
            $request->bannerimage->storeAs('uploads/news',$bannerimageName,'public');
             $destinationPath = storage_path('app/public/uploads/news-thumbnail');
                $img = Image::make($request->bannerimage->path());
                $img->resize(300, 300, function ($constraint) {
                    //$constraint->aspectRatio();
                })->save($destinationPath.'/'.$bannerimageName);
        }

        News::findorfail($newsid)->update([
          'title'=>$request->title,
          'slug'=>$request->slug, 
          'status'=>$request->status,
          'description'=>$request->description,
          'bannerimage'=>$bannerimageName, 
          'bannerimagealttext'=>$request->bannerimagealttext, 
          'metatitle'=>$request->metatitle, 
          'metakeywords'=>$request->metakeywords, 
          'metadescription'=>$request->metadescription,
        ]);
        
        $notification = array(
          'message'=> 'News updated sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
    }
    public function deletenews($id){
        $news= News::findorfail($id);
        Storage::disk('public')->delete('/uploads/news/' . $news->bannerimage);
        News::findorfail($id)->delete();
        
        $notification = array(
          'message'=> 'News deleted sucessfully',
           'alert-type' =>'success' 
        );
        
        return redirect()->back()->with($notification);
    }
    public function editnews($id){
        $news= News::findorfail($id);
        return view('backend.news.editnews',compact('news'));
    }
    public function checknewsslug(Request $request)
    {
        //$slug = str_slug($request->title);
        $slug = SlugService::createSlug(News::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
