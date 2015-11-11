<?php

return [
    'version' => 5,
    'namespace' => 'App\WordPress',
    'directories' => [
        'classes',
    ],
    'files' => [
        'helpers.php',
    ],
    'paths' => [
        'config' => 'config',
        'lang' => 'resources/lang',
        'views' => 'resources/views',
    ],
    'providers' => [
        App\WordPress\Providers\AddonServiceProvider::class,
        App\WordPress\Providers\RouteServiceProvider::class,
    ],
    'console' => [
        'commands' => [
        ],
    ],
    'http' => [
        'middlewares' => [
        ],
        'route_middlewares' => [
            'wordpress.blog_admin_bootstrap' => App\WordPress\Http\Middleware\BlogAdminBootstrapMiddleware::class,
            'wordpress.site_admin_bootstrap' => App\WordPress\Http\Middleware\SiteAdminBootstrapMiddleware::class,
            'wordpress.template_bootstrap' => App\WordPress\Http\Middleware\TemplateBootstrapMiddleware::class,
        ],
    ],
    'includes_global_aliases' => true,
    'aliases' => [
    ],
];
