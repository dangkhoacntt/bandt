<?php

namespace App\Http\Controllers;
use App\Models\Baner;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Comment;
class FrontendController extends Controller
{
    //

        public function index()
        {
            $baners = Baner::all();
            return view('frontend.master', compact('baners'));
        }
    public function gethome(){
        $data['featured'] = Product::where('prod_featured',1)->orderBy('prod_id','desc')->take(8)->get();
        $data['news'] = Product::orderBy('prod_id','desc')->take(8)->get();
$data['banners'] = Baner::all();
        return view('frontend.home',$data);

    }
    public function getsingle(){
        return view('frontend.singlemenu',$data);

    }
    public function getDetail($id){
        $data['item'] = Product::find($id);
        $data['comments'] = Comment::where('com_product',$id)->get();
        $data['banners'] = Baner::all();
        return view('frontend.details', $data);
    }
    public function getCategory($id){
        $data['cateName'] = Category::find($id);
        $data['items'] = Product::where('prod_cate',$id)->orderBy('prod_id','desc')->paginate(8);
        $data['banners'] = Baner::all();
        return view('frontend.category', $data);
    }
    public function postComment(Request $request,$id){
        $data['banners'] = Baner::all();
        $comment = new Comment;
        $comment->com_name = $request->name;
        $comment->com_email = $request->email;
        $comment->com_content = $request->content;
        $comment->com_product = $id;
        $comment->save();
        return back();
    }
    public function getSearch(Request $request){
        $data['banners'] = Baner::all();
        $result = $request->result;
        $data['keyword'] = $result;
        $result = str_replace(' ', '%', $result);
        $data['items'] = Product::where('prod_name','like','%'.$result.'%')->get();
        return view('frontend.search',$data);
    }

}
