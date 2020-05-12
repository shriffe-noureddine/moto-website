<?php

namespace App\Http\Middleware;

use Closure;

class XssSanitizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //https://decodeweb.in/php/php-frameworks/laravel-framework/form-validation-and-user-input-sanitization-tricks-in-laravel/
        $input = $request->all();

        array_walk_recursive($input, function(&$input) {

            $input = strip_tags($input);

        });

        $request->merge($input);

        return $next($request);
       
    }
}
