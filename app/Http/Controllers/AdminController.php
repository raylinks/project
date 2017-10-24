<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\Comment;
use App\Models\Like;
use Gate;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth')->except(['admin_reg', 'p_admin_reg', 'login', 'showLoginForm']);
    }

      public function admin_reg()
    {
        return view('auth.a_register');
    }

    public function p_admin_reg(Request $req)
    {
        $data = $req->all();
        $this->validation($req);
        $user = new User();
        $user->full_name = $data['full_name'];
        $user->email = $data['email'];
        $user->phone_num = $data['phone_num'];
        $user->password = bcrypt($data['password']);
        $user->is_admin = 2;
        $user->save();

        session()->flash('success', 'Admin details saved');
        return redirect()->back();
    }

    public function validation($req)
    {
        return $this->validate($req, [
            'full_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'phone_num' => 'required|min:11',
            'password' => 'required|min:6|confirmed',
            ]);
    }

      public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            ]);
          if(Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'is_admin' => 2,
                ], $request->has('remember')))
            {
                return redirect()->route('admin.profile');
            }
          

        session()->flash('danger', 'Authentication failed! Try again');
        return redirect()->back();
    }


    

  

    public function profile()
    {
       /* if(auth()->user()->is_admin !== 2)
        {
            return redirect()->to(url('/'));
        }*/
        $users = User::where('is_admin', 2)->get();
        $posts = Post::latest()->simplePaginate(3);
        return view('admin.profile', compact('users', 'posts'));
    }

    public function profile_picture(Request $request)
    {
        if($request->id != auth()->user()->id )
        {
            session()->flash('danger', 'Login to perform this operation');
            return redirect()->back();
        }

        $file = $request->file('profile_image');
        $theImages = "";
        $rules = array('file' => 'required:mimes:png,gif,jpeg');
        $validator = Validator::make(array('file' => $file), $rules);
        if ($validator->passes())
        {
            $destination = 'profile_pics/' . microtime(true);
            $filename = $file->getClientOriginalName();
            $theImages = $destination . '/' . $filename;
            $upload_success = $file->move($destination, $filename);
        }else{
            session()->flash('danger', 'Validation was not successful');
        }
        User::where('id', $request->id)->update(['profile_pic' => $theImages]);
        session()->flash('success', Auth::user()->full_name .'&nbsp;' . 'Profile Picture Updated Successfully');
        return redirect()->back();
    }

    public function getCreatePost()
    {
        $users = DB::table('users')->where('is_admin', 2)->get();
        $tags = Tag::all();
        return view('admin.create-post', compact('users', 'tags'));
    }

    public function submitCreatePost(Request $request)
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

    public function manageUsers()
    {
        $users = User::where('is_user', 1)->simplePaginate(3);
         $admins = User::where('is_admin', 2)->get();
        return view('admin.manage-users', compact('users', 'admins'));
    }

      public function DeletePost($id)
    {
        # we find and get post with the id matching the id we are passing
        $post = Post::find($id);

        # deletes all related comments to the post
        $post->comments()->delete();
         $post->likes()->delete();
        # detach all tags associated to the post
        $post->tags()->detach();
        # finally deletes the post
        $post->delete();
        return redirect()->back()->with('danger', 'Post Deleted');

    }

     public function getUpdatePost($id)
    {
         $users = User::where('is_admin', 2)->get();
      # we find and get the post with the id matching the id in the request
        $posts = Post::find($id);
        # we get all the tags
        $tags = Tag::all();
        return view('admin.admin-update-post', ['posts' => $posts, 'postId' => $id, 'tags' => $tags, 'users' => $users]);
      #  return view('admin.update-post', compact('posts', 'tags'));
    }



    public function postUpdatePost(Request $request)
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

    public function deleteUser($id)
    {
       # $users = User::where('id', $id)->delete();
         $user_get = User::where('id', $id)->first();
         User::where('id', $id)->delete();
       
         if(count($user_get))
         {
            Post::where('user_id', $user_get->user_id)->delete();
            Comment::where('user_id', $user_get->user_id)->delete();
            Like::where('user_id', $user_get->user_id)->delete();
         }
        session()->flash('success', 'User deleted successfully');
        return redirect()->back();

    }


 

}
