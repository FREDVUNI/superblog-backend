<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Auth;
use Image;
use DB;
 
class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware("auth:api");
    }
    public function index()
    {
        $posts = Post::with("category","user")->get();
        return $posts;
    }
    public function edit($id)
    {
        $post = DB::select("select posts.*,categories.category from posts inner join categories on posts.category_id = categories.id where
        posts.id = $id");
        
        // select * from `posts,categories` inner join `categories` on `posts`.`category_id` =
        // `categories`.`id` where `posts`.`id` = 12
        //  ->join('categories', 'posts.category_id', '=', 'categories.id')
        //  ->where('posts.id', $id)
        //  ->get();
        return response()->json($post[0],200);
        // return $post;
    }
    public function store(Request $request)
    {

        $userid = auth('api')->user()->id; 
        $request->validate([
            "title" => "required|max:150|unique:posts",
            "description" => "required|max:300",
            "category_id" => "required",
            // "image" => "required|image|mimes:jpg,jpeg,gif,png|max:2048"
        ]);
        $strpos = strpos($request->image,";");
        $sub = substr($request->image,0,$strpos);
        $ext = explode("/",$sub)[1];
        $name = md5(microtime()).".".$ext;

        $file = Image::make($request->image)->resize(200,200);
        $path = public_path('/uploads/posts/');
        $file->save($path.$name);

        $post = new Post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->image = $name;
        $post->user_id = $userid;

        $postData = $post->save();
        return $postData;
    }
    public function update(Request $request,$id)
    {
        $post = Post::FindorFail($id);
        $request->validate([
            "title" => "required|max:150",
            "description" => "required|max:300",
            "category_id" => "required",
        ]);        
        if($request->image != $post->image):
            $strpos = strpos($request->image,";");
            $sub = substr($request->image,0,$strpos);
            $ext = explode("/",$sub)[1];
            $name = md5(microtime()).".".$ext;

            $file = Image::make($request->image)->resize(200,200);
            $path = public_path('/uploads/posts/');
            $image = $path.$post->image;

            // $request->validate([
            //     $image => "required|image|mimes:jpg,jpeg,png,gif"
            // ]);

            $file->save($path.$name);

            if(file_exists($image)):
@unlink($image);
            endif;
        else:
            $name = $post->image;
        endif;

        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->image = $name;
        $post->save();
        return $post;
    }

    //     $user = auth('api')->user();
    //     $request->validate([
    //         "title" => "required|max:50",
    //         "description" => "required|max:180",
    //         "category_id" => "required",
    //     ]);
    //     if($user->image != $request->image):
    //         $strpos = strpos($request->image,";");
    //         $sub = substr($request->image,0,$strpos);
    //         $ext = explode("/",$sub)[1];
    //         $name = md5(microtime()).".".$ext;

    //         $request->validate([
    //             "image" => "required|image|mimes:jpg,jpeg,png,gif"
    //         ]);

    //         if(file_exists($request["image"])):
    //             $path = public_path("uploads/posts/");
    //             $old = $path.$user->image;
    //             if($user->image != "default.png"):
    //                 unlink($old);
    //             endif;
    //         endif;
    //         $file = Image::make($request->image)->resize(200,200);
    //         $path = public_path('/uploads/posts/');
    //         $file->save($path.$name);

    //         $request->validate([
    //             "image" => "required|image|mimes:jpg,jpeg,gif,png|max:2048"
    //         ]);
    //     endif;
    //     $post = new Post();
    //     $post->title = $request['title'];
    //     $post->description = $request['description'];
    //     $post->category_id = $request['category_id'];
    //     $post->image = $name;

    //     $post->update($request->all());
    //     return $post;
    // }

    public function delete(Request $request,$id){
        $post = Post::FindorFail($id);
        if($post->image != NULL || $post->image = "" || file_exists($post->image)):
            $path = public_path("uploads/posts/");
            $old =$post->image;
            unlink($path.$old);
        endif;
        $post->delete();
        return $post;
    }

     public function profile()
     {
        return auth("api")->user();
     }
}
