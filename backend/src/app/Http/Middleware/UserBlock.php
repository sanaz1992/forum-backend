<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBlock
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isBlock = resolve(UserRepository::class)->isBlock();
        if (auth()->check() && !$isBlock) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'user is block.'
            ], Response::HTTP_FORBIDDEN);
        }

    }
}
