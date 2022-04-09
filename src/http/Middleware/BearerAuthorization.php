<?php

namespace AbediMostafa\ToDo\http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BearerAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken() !== Auth::user()->api_token) {
            throw new AuthenticationException;
        }

        return $next($request);
    }
}
