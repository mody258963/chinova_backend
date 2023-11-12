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


       $data =  $request->validate([
            'description' => 'required|max:1255|min:3|string',
            'title'=> 'required|max:1255|min:3|string',
            'price'=> 'required|max:1255|min:1',
            'wieght'=> 'required|max:1255|min:1',
            'image'=> 'image|required|max:2032',
        ]);
        $image = '';
        if($request->has('image')){
            $image  = $request->file("image")->store('public/posts');
        }
        $image = str_replace('public','storage',$image);
        $data['image'] = $image;
        $data['user_id'] = 2;
        $user = Auth::user();
        if(!$user){
            return abort(403);
        }
        $post = Order::create($data);
        if($post){
            session()->flash("message","post edited successfully");
            return redirect(route('posts.index'));
        }

        return redirect()->back()->with('error','This post not created');
    }

    public function edit(Order $post){
        return view('dashboard.posts.edit',[
            'post' => $post,
        ]);
    }

    public function update(Request $request){

        $data =  $request->validate([
            'description' => 'required',
            'title'=> 'required',
            'price'=> 'required',
            'wieght'=> 'required',
            'image'=> 'nullable',
            'id' => 'required',
        ]);
        if(isset($data['image'])){
            $path = $request->image->store('public/posts');
            $path = str_replace('public','storage',$path);
            $data['image'] = $path;
        }
        $post = Order::find($data['id']);
        unset($data['id']);
        $post->update($data);
        return redirect(route('posts.index'))->with('edit',"Post Edit Successfully!");
    }


    public function delete($id){
        $post = Order::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('delete','item deleted successfully');
    }


    }


