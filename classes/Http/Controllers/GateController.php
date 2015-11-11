<?php

namespace App\WordPress\Http\Controllers;

/**
 *
 */
class GateController extends Controller
{
    public function __construct()
    {
    }

    public function login()
    {
        $this->runScript('wp-login.php', [
            'wpdb',
            'current_site', // for wp-includes/ms-functions.php
            'user_login', 'error',
        ]);
    }
}
