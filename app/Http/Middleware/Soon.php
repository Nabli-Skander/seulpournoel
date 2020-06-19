<?php

namespace App\Http\Middleware;

use Closure;

class Soon
{
    private $excludes = ['soon', 'home', 'help', 'legal', 'terms'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('SOON') && !in_array($request->route()->getName(), $this->excludes)) {
            return redirect(route('soon'));
        }

        return $next($request);
    }
}
