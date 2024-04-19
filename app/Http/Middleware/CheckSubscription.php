<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has a subscription
        if (Auth::check() && Auth::user()->subscription()->exists()) {
            // User has a subscription, proceed to the next middleware or route handler
            return $next($request);
        }

        // User does not have a subscription, redirect to the pricing page
        return redirect()->route('pricing');
    }
}
