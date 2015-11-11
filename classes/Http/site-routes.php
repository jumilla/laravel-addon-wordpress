<?php

if (!function_exists('add_site_file_download_routes')) {
    function add_site_file_download_routes($router)
    {
        $action = 'FileProvideController@downloadOnSite';

        $router->get('{f1}', $action);
        $router->get('{f1}/{f2}', $action);
        $router->get('{f1}/{f2}/{f3}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}/{f5}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}/{f5}/{f6}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}/{f5}/{f6}/{f7}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}/{f5}/{f6}/{f7}/{f8}', $action);
        $router->get('{f1}/{f2}/{f3}/{f4}/{f5}/{f6}/{f7}/{f8}/{f9}', $action);
    }
}

// /wp-includes for site
// MEMO: theme 'twentyfifteen' using...
$router->group(['prefix' => 'wp-includes'], function ($router) {
    add_site_file_download_routes($router);
});

// /wp-content for site
$router->group(['prefix' => 'wp-content'], function ($router) {
    // provide files, about css, js, png, ...others.
    add_site_file_download_routes($router);
});

// Templates
$router->group(['prefix' => ''], function ($router) {
    $action = 'TemplateController@provide';

    $router->get('', $action);
    $router->post('', $action);
    $router->get('{p1}', $action);
    $router->post('{p1}', $action);
    $router->get('{p1}/{p2}', $action);
    $router->post('{p1}/{p2}', $action);
    $router->get('{p1}/{p2}/{p3}', $action);
    $router->post('{p1}/{p2}/{p3}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}/{p5}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}/{p5}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}/{p8}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}/{p8}', $action);
    $router->get('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}/{p8}/{p9}', $action);
    $router->post('{p1}/{p2}/{p3}/{p4}/{p5}/{p6}/{p7}/{p8}/{p9}', $action);
});
