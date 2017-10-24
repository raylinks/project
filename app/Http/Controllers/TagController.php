<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Auth;


use Illuminate\Http\Request;

class TagController extends Controller
{
	public function __construct()
   {
      $this->middleware('auth');
   }

    public function indexByTags(Tag $tags)
    {

      	$user = Auth::user();
    	# get posts and its associated tags
    	$posts = $tags->posts;
    	return view('tag-post', compact('posts', 'user'));
    }
}
