<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubscriptionApiPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiPassword = $request->header('API_PASSWORD');

        if ($apiPassword !== env('API_PASSWORD')) {
            $response = [
                'success' => false,
                'message' => 'API Password is incorrect.',
            ];
            return response()->json($response, 401);
        }
        return $next($request);
    }
}
