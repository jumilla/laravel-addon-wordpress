<?php

namespace App\WordPress\Http\Controllers;

use App\Http\Controllers\Controller as AppController;

/**
 *
 */
abstract class Controller extends AppController
{
    use \App\WordPress\Services\WordPressService;
}
