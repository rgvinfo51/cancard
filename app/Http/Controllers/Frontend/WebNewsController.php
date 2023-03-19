<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;

class WebNewsController extends Controller
{
    public function allnews(){
        $news=DB::table('news')->where('status','1')->orderBy('id', 'desc')->paginate(10);
        return view('frontend.news.listing',compact('news'));
    }
    
    public function newsdetail(Request $request){
        $newsdetail= DB::table('news')->where('status','1')->where('slug',$request->slug)->orderBy('id', 'desc')->first();
        if($newsdetail){  
            return view('frontend.news.detail',compact('newsdetail'));
        }
        else{
            return redirect()->route('page404');
        }
        
    }
  
}
