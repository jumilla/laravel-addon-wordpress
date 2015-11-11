<?php

namespace App\WordPress\Http\Controllers;

/**
 *
 */
class UserController extends Controller
{
    public function __construct()
    {
    }

    public function signup()
    {
        $this->runScript('wp-signup.php', [
            'wpdb',
        ]);
    }

    public function activate()
    {
        $this->runScript('wp-activate.php', []);
    }

    public function commentPost()
    {
        $this->runScript('wp-comments-post.php', []);
    }
}
