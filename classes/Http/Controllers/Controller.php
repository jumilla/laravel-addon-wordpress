<?php

namespace App\WordPress\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 *
 */
abstract class Controller extends BaseController
{
    use \App\WordPress\Services\WordPressService;

    public function __construct()
    {
        View::share('__addon', addon());
    }
}
