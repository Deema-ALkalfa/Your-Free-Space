<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('partials.sidebar', function ($view) {
            $view->with('recentPosts', Post::orderBy('created_at', 'desc')->take(5)->get());
        });
    }
}
