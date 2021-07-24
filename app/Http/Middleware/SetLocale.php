<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = array_keys(config('app.languages'));
        $route = $request->route();

        if (request('lang')) {
            $language = request('lang');

            if (in_array($language, $languages)) {
                app()->setLocale($language);
            }
        }else{
            app()->setLocale('en');
        }

        return $next($request);
    }
}
