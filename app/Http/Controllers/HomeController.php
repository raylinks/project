<?php


namespace App\Http\Controllers;
use App\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use Gate;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function getNewPost()
    {
        $users = User::where('is_user', 1)->get();
        $tags = Tag::all();
        return view('gitblog.new-post', compact('tags', 'users'));
    }

     public function submitNewPost(Request $request)
    {
       $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            ]);
        
        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if($request->hasFile('post_image')) {
            #we get the image from the form
             $file = $request->file('post_image');
            $thePostImages = "";
            $filename = $file->getClientOriginalName();
            $destination = 'post_images/' . microtime(true);
            $thePostImages = $destination . '/' . $filename;
            $upload_success = $file->move($destination, $filename);
           
            $post->image = $thePostImages; 
        }

             $post->save();

              $post->tags()->attach($request->input('tags') === null ? [] : $request->input('tags'));


        session()->flash('success', 'Post added successfully!');
        return redirect()->back();
    }

      public function getEditNewPost($id)
    {
        # we find and get the post with the id matching the id in the request
        $posts = Post::find($id);
        # we get all the tags
        $tags = Tag::all();
        return view('gitblog.update-post', ['posts' => $posts, 'postId' => $id, 'tags' => $tags]);
      #  return view('admin.update-post', compact('posts', 'tags'));
    }



    public function postEditNewPost(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'content' => 'required',        
        ]);

        $post = Post::find($request->input('id'));
        if(Gate::denies('manipulate-post', $post)) 
        {
            return redirect()->back()->with('danger', 'Access Denied!');
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');

         if($request->hasFile('post_image')) {
            #we get the image from the form
             $file = $request->file('post_image');
            $thePostImages = "";
            $filename = $file->getClientOriginalName();
            $destination = 'post_images/' . microtime(true);
            $thePostImages = $destination . '/' . $filename;
            $upload_success = $file->move($destination, $filename);
           
            $post->image = $thePostImages; 
        }

        $post->save();
        #$post->tags()->detach();
        #$post->tags()->attach($data['tags'] === null ? [] : $data['tags']);
        $post->tags()->sync($request->input('tags') === null ? [] : $request->input('tags'));
        #$post->tags()->sync($request->input('tags'), false);

        return redirect()->back()->with('success', 'Post edited, New Title is: '. $request->input('title'));
    }

    
     public function PostDelete($id)
    {
        # we find and get post with the id matching the id we are passing
        $post = Post::find($id);

         if(Gate::denies('manipulate-post', $post)) 
        {
            return redirect()->back()->with('danger', 'Access Denied!');
        }
        # deletes all related comments to the post
        $post->comments()->delete();
        # detach all tags associated to the post
        $post->tags()->detach();
        # finally deletes the post
        $post->delete();
        return redirect()->back()->with('danger', 'Post Deleted');

    }

    public function userProfile()
    {
      $user = Auth::user();
      return view('gitblog.profile', compact('user'));
    }
  
}
