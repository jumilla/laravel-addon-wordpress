<?php

use App\WordPress\Services\WordPress;

$wp_backend_prefix = config('wordpress.url.backend_prefix');
$wp_site_prefix = config('wordpress.url.site_prefix');

if (!function_exists('add_backend_file_download_routes')) {
    function add_backend_file_download_routes($router)
    {
        $action = 'FileProvideController@downloadOnBackend';
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

// Login Gate
$router->group(['prefix' => $wp_backend_prefix], function ($router) {
    // ?action = ['postpass', 'logout', logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'register']
    $router->get('wp-login.php', 'GateController@login');
    $router->post('wp-login.php', 'GateController@login');
});

// Shortcuts
$router->group(['prefix' => $wp_backend_prefix], function ($router) {
    $admin_url = config('wordpress.url.backend').'/wp-admin/';

    // WordPress+ original routing
    if (config('wordpress.url.backend') != config('wordpress.url.site')) {
        $router->get('', function () use ($admin_url) { return redirect()->to($admin_url); });
    }

    // MEMO from wp_redirect_admin_locations() on 'wp-includes/canonical.php'
    $router->get('login', 'GateController@login');
    $router->get('admin', function () use ($admin_url) { return redirect()->to($admin_url); });
    $router->get('dashboard', function () use ($admin_url) { return redirect()->to($admin_url); });
});

// /wp-admin/network
$router->group(['prefix' => $wp_backend_prefix.'wp-admin/network'], function ($router) {
    $router->get('', 'SiteAdminController@siteDashboard');
    foreach (WordPress::siteAdminScripts() as $script) {
        $router->get($script, 'SiteAdminController@sitePage');
        $router->post($script, 'SiteAdminController@sitePage');
    }
});

// /wp-admin
$router->group(['prefix' => $wp_backend_prefix.'wp-admin'], function ($router) {
    //--- Dashboard ---//

    $router->get('', ['as' => 'wordpress.admin.dashboard', 'uses' => 'BlogAdminController@dashboard']);
    $router->get('index.php', function () {
        return redirect()->route('wordpress.admin.dashboard');
    });

    //--- Setup ---//

    $router->get('setup-config.php', 'SetupController@setupConfig');
    $router->post('setup-config.php', 'SetupController@setupConfig');
    $router->get('install.php', 'SetupController@setupInstall');
    $router->post('install.php', 'SetupController@setupInstall');

    //--- Updates ---//

    $router->get('update-core.php', 'BlogAdminController@updateCore');
    $router->post('update-core.php', 'BlogAdminController@updateCore');
    $router->get('update.php', 'BlogAdminController@update');
    $router->post('update.php', 'BlogAdminController@update');
    $router->get('upgrade.php', 'BlogAdminController@upgrade');

    //--- Admin ---//

    $router->get('admin.php', 'BlogAdminController@admin');
    $router->post('admin.php', 'BlogAdminController@admin');
    $router->get('admin-ajax.php', 'BlogAdminController@adminAjax');
    $router->post('admin-ajax.php', 'BlogAdminController@adminAjax');

    //--- Themes ---//

    $router->get('themes.php', 'BlogAdminController@themeList');
    $router->post('themes.php', 'BlogAdminController@themeList');
    $router->get('theme-install.php', 'BlogAdminController@themeInstall');
    $router->get('customize.php', 'BlogAdminController@themeCustomize');
    $router->get('widgets.php', 'BlogAdminController@themeWidgetList');
    $router->get('nav-menus.php', 'BlogAdminController@themeNavMenus');
    $router->post('nav-menus.php', 'BlogAdminController@themeNavMenus');
    $router->get('theme-editor.php', 'BlogAdminController@themeFileList');
    $router->post('theme-editor.php', 'BlogAdminController@themeFileList');

    //--- Plugins ---//

    $router->get('plugins.php', 'BlogAdminController@pluginList');
    $router->post('plugins.php', 'BlogAdminController@pluginList');
    $router->get('plugin-install.php', 'BlogAdminController@pluginInstall');
    $router->get('plugin-editor.php', 'BlogAdminController@pluginEditor');

    //--- Users ---//

    $router->get('users.php', 'BlogAdminController@userList');
    $router->post('users.php', 'BlogAdminController@userList');        // action=remove
    $router->get('user-new.php', 'BlogAdminController@userNew');
    $router->post('user-new.php', 'BlogAdminController@userNew');
    $router->get('user-edit.php', 'BlogAdminController@userEdit');
    $router->post('user-edit.php', 'BlogAdminController@userEdit');
    $router->get('profile.php', 'BlogAdminController@userProfile');
    $router->post('profile.php', 'BlogAdminController@userProfile');

    //--- Posts ---//

    $router->get('edit.php', 'BlogAdminController@postList');
    $router->post('edit.php', 'BlogAdminController@postList');
    $router->get('revision.php', 'BlogAdminController@postRevision');
    $router->get('post-new.php', 'BlogAdminController@postNew');
    $router->post('post-new.php', 'BlogAdminController@postNew');
    $router->get('post.php', 'BlogAdminController@postEdit');
    $router->post('post.php', 'BlogAdminController@postEdit');
    $router->get('edit-tags.php', 'BlogAdminController@tagList');
    $router->post('edit-tags.php', 'BlogAdminController@tagList');
    $router->get('edit-comments.php', 'BlogAdminController@commentList');
    $router->get('comment.php', 'BlogAdminController@commentEdit');
    $router->post('comment.php', 'BlogAdminController@commentEdit');

    //--- Media ---//

    $router->get('upload.php', 'BlogAdminController@mediaUpload');
    $router->post('async-upload.php', 'BlogAdminController@mediaAsyncUpload');
    $router->get('media-new.php', 'BlogAdminController@mediaNew');
        $router->get('media.php', 'BlogAdminController@mediaManagerOld');
        $router->get('media.php', 'BlogAdminController@mediaManagerOld');
        $router->get('media-upload.php', 'BlogAdminController@mediaUploadOld');
        $router->post('media-upload.php', 'BlogAdminController@mediaUploadOld');

    //--- Tools ---//

    $router->get('tools.php', 'BlogAdminController@tools');
    $router->get('press-this.php', 'BlogAdminController@toolPressThis');
    $router->get('import.php', 'BlogAdminController@toolImport');
    $router->get('export.php', 'BlogAdminController@toolExport');
    $router->get('network.php', 'BlogAdminController@toolNetwork');
    $router->post('network.php', 'BlogAdminController@toolNetwork');

    //--- Links ---//

    $router->get('link-manager.php', 'BlogAdminController@linkList');
    $router->get('link-add.php', 'BlogAdminController@linkAdd');
    $router->get('link.php', 'BlogAdminController@linkEdit');
    $router->post('link.php', 'BlogAdminController@linkEdit');

    //--- Settings ---//

    $router->get('options-general.php', 'BlogAdminController@optionsGeneral');
    $router->post('options-general.php', 'BlogAdminController@optionsGeneral');
    $router->get('options-writing.php', 'BlogAdminController@optionsWriting');
    $router->get('options-reading.php', 'BlogAdminController@optionsReading');
    $router->get('options-discussion.php', 'BlogAdminController@optionsDiscussion');
    $router->get('options-media.php', 'BlogAdminController@optionsMedia');
    $router->get('options-permalink.php', 'BlogAdminController@optionsPermaLink');
    $router->post('options-permalink.php', 'BlogAdminController@optionsPermaLink');
    $router->get('options.php', 'BlogAdminController@optionsEdit');
    $router->post('options.php', 'BlogAdminController@optionsEdit');

    //--- About ---//

    $router->get('about.php', 'BlogAdminController@about');
    $router->get('credits.php', 'BlogAdminController@aboutCredits');
    $router->get('freedoms.php', 'BlogAdminController@aboutFreedoms');

    //--- Multisite ---//

    $router->get('my-sites.php', 'BlogAdminController@multisiteList');

    //--- File Content Provider ---//

    $router->get('load-styles.php', 'FileProvideController@loadStyles');
    $router->get('load-scripts.php', 'FileProvideController@loadScripts');
    add_backend_file_download_routes($router);
});

// /wp-includes for backend
$router->group(['prefix' => $wp_backend_prefix.'wp-includes'], function ($router) {
    // irregular
    $router->get('js/tinymce/wp-mce-help.php', 'BlogAdminController@runPhpScript');
    $router->get('js/tinymce/wp-tinymce.php', 'BlogAdminController@runPhpScript');

    // provide files, about css, js, png, ...others.
    add_backend_file_download_routes($router);
});

// /wp-content for backend
$router->group(['prefix' => $wp_backend_prefix.'wp-content'], function ($router) {
    // provide files, about css, js, png, ...others.
    add_backend_file_download_routes($router);
});

// /wp-includes for site
// MEMO: theme 'twentyfifteen' using...
$router->group(['prefix' => $wp_site_prefix.'wp-includes'], function ($router) {
    add_site_file_download_routes($router);
});

// /wp-content for site
$router->group(['prefix' => $wp_site_prefix.'wp-content'], function ($router) {
    // provide files, about css, js, png, ...others.
    add_site_file_download_routes($router);
});

// Users
$router->group(['prefix' => $wp_backend_prefix], function ($router) {
    $router->get('wp-signup.php', 'UserController@signup');
    $router->post('wp-signup.php', 'UserController@signup');
    $router->get('wp-activate.php', 'UserController@activate');

    $router->post('wp-comments-post.php', 'UserController@commentPost');
});

// Collaborations
$router->group(['prefix' => $wp_backend_prefix], function ($router) {
    //--- Site information ---//
//		$router->get('?feed=rss2', 'TemplateController@provide');
//		$router->get('?feed=comments-rss2', 'TemplateController@provide');
    $router->get('wp-links-opml.php', 'CollaborationController@opml');

    $router->get('wp-mail.php', 'CollaborationController@mail');
    $router->get('wp-trackback.php', 'CollaborationController@trackback');

    $router->get('xmlrpc.php', 'CollaborationController@xmlrpc');
    $router->post('xmlrpc.php', 'CollaborationController@xmlrpc');
    $router->get('wp-cron.php', 'CollaborationController@cron');
    $router->post('wp-cron.php', 'CollaborationController@cron');
});

// Templates
$router->group(['prefix' => $wp_site_prefix], function ($router) {
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
