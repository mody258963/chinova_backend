<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $posts = Order::all();
        return view('dashboard.posts.list-posts',[
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('dashboard.posts.create-post');
    }
    public function store(Request $request){
        $user = Auth::user();
        if(!$user){
            return abort(403);
        }
       $data =  $request->validate([
            'description' => 'required|max:1255|min:3|string',
            'image' => 'image|required',
        ]);

        $post = Order::create($data);
        if($post){
            session()->flash("message","post created successfully");
            return redirect(route('posts.index'));
        }

        return redirect()->back()->with('error','This post not created');
    }

    public function edit(Order $post){ 
        return view('post-edit',[
            'post' => $post,
        ]);
    }
}
