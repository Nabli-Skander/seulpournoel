<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SaveLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            // Get the user specific language
            $user = Auth::user();
            $cur = \LaravelLocalization::getCurrentLocale();
            // Set the language
            if ($cur != $user->lang) {
                $user->lang = $cur;
                $user->save();
            }
        }
        return $next($request);
    }
}
