<?php

namespace App\Providers;
use App\Models\Tag;
use App\Models\Post;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('layouts.sidebar', function ($view) {
            # gimme the tags as long as it has post associated with it
            $tags = Tag::has('posts')->pluck('name');

            $view->with(compact('tags')); 
        });


        view()->composer('layouts.sidebar2', function ($view) {
            # gimme the tags as long as it has post associated with it
            $archives = Post::archives();

            $view->with(compact('archives')); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
