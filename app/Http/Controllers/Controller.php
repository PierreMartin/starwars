<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use View;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        // injecter du code dans la vue 'partials.categories' : ($view -> template)
        view::composer('partials.categories', function($view) {
            $view->with('categories', Category::all());
        });

        view::composer('partials.tags', function($view) {
            $view->with('tags', Tag::all());
        });

    }

}
