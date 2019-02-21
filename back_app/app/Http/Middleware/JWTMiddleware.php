<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Helpers\JsonFormatter;

class JWTMiddleware extends BaseMiddleware
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
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return JsonFormatter::error_404('User Not found');
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return JsonFormatter::errors([
                'message' => 'Token expired',
                'code' => 'token_expired',
                'errors' => []
            ], $e - getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return JsonFormatter::errors([
                'message' => 'Invalid token',
                'code' => 'token_invalid',
                'errors' => []
            ], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return JsonFormatter::errors([
                'message' => 'Token not found',
                'code' => 'token_not_found',
                'errors' => []
            ], $e->getStatusCode());
        }

        return $next($request);
    }
}
