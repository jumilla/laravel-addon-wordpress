<?php

use App\WordPress as Addon;

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
        Addon\Providers\AddonServiceProvider::class,
        Addon\Providers\RouteServiceProvider::class,
        Addon\Providers\WordPressServiceProvider::class,
    ],
    'console' => [
        'commands' => [
            Addon\Console\Commands\StatusCommand::class,
            Addon\Console\Commands\InstallCommand::class,
            Addon\Console\Commands\UninstallCommand::class,
            Addon\Console\Commands\MultisiteInstallCommand::class,
            Addon\Console\Commands\MultisiteUninstallCommand::class,
            Addon\Console\Commands\ThemeListCommand::class,
            Addon\Console\Commands\PluginListCommand::class,
            Addon\Console\Commands\KeysMakeCommand::class,
            Addon\Console\Commands\ThemeMakeCommand::class,
            Addon\Console\Commands\PluginMakeCommand::class,
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
