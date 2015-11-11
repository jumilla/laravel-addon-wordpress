<?php

namespace App\WordPress\Http\Middleware;

use Closure;

class TemplateBootstrapMiddleware
{
    use \App\WordPress\Services\WordPressService;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // save keys for $GLOBALS
        $globals_before_keys = $this->getGlobalsKeys();

        // load wordpress objects
        $this->bootstrap();

        // detect newers
        $wordpress_globals = $this->detectNewGlobals($globals_before_keys);

        // register to service container
        app()->instance('wordpress.globals', $wordpress_globals);
//        info(print_r(app('wordpress.globals'), true));

        return $next($request);
    }

    private function bootstrap()
    {
        $this->runTemplateBootstrapScript();
    }
}
