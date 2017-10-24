<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\User;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Like;
use Auth;

use Illuminate\Http\Request;


class UserController extends Controller
{

	public function __construct()
   {
      $this->middleware('auth')->except('ind');
   }



 	 public function ind()
   	 {
      
	$posts = Post::latest()->simplePaginate(4);
   	return view('index', compact('posts'));
    }

       # function to display posts by id
   public function showPostByID($id)
   {
      $user = Auth::user();
    # find the post matching the id we are passing
      $tags = Tag::all();
      $post = Post::find($id);
      $post = Post::where('id', $id)->with(['likes', 'comments'])->first();
    return view('show', compact('post', 'tags', 'user'));
   }

    # Function to store the comments
   public function storeComment(Post $post)
   {
      $user = Auth::User();
      # add a comment to a post through the body of the comment
       #$post->addComment(request('body'));
      Comment::create([

         'full_name' => request('full_name'),
         'email' => request('email'),
         'body' => request('body'),
         'user_id' => $user->id,
         'post_id' => $post->id,
         ]);
     
      session()->flash('success', 'Comments added successfully');
      return redirect()->back();
   }


   public function profileLike($id)
    {
        $user = Auth::user();
        # Get all the post where the id is the same as the id being passed in the function
        $post = Post::where('id', $id)->first();
        # create an object of the like Model
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id; 
        $post->likes()->save($like);

        return redirect()->back();
    }


   public function profileUnLike($id)
    {
       $user = Auth::user();
        # Get all the post where the id is the same as the id being passed in the function
        $like = new Like();
        $post = Post::where('id', $id)->first();
        if(count($post))
        {

        Like::where('user_id', $user->id)->delete();
        }
        # create an object of the like Model
         return redirect()->back();
    }

}
