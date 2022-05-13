<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;

class PostController extends Controller
{
    public function index()
    {
    $posts = Post::with("category","user")->get();
    return $posts;
    }
    public function show($id)
    {
        // $post = Post::FindorFail($id);
        $post = Post::with("category","user")->where("id",$id)->get();
        return $post[0];
    }
    public function post_category($id){
         $post = Post::with("category","user")->where("category_id",$id)->get();
         return $post;
    }
    public function latest_posts(){
        $posts = Post::with("category")->orderBy("id","DESC")->limit(5)->get();
        return $posts;
    }
    public function search_posts(){
        $search = request()->s;
        $posts = Post::with("category")
        ->where("title","LIKE","%$search%")
        ->orwhere("description","LIKE","%$search%")
        ->get();
        return $posts;

    }
}
