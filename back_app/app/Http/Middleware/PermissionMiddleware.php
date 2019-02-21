<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Facades\PermissionHelper;
use App\Http\Helpers\JsonFormatter;

/**
 * Class PermissionMiddleware
 * @package App\Http\Middleware
 */
class PermissionMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @param string $group
     * @param mixed ...$permissions
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next, string $group, ...$permissions)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $userHasGroup = $user->hasGroup($group);

        if (!$userHasGroup) {
            return JsonFormatter::errors([
                'message' => "Missing role",
                'code' => 'missing_role',
                'errors' => []
            ], 404);
        }

        if (!empty($permissions)) {
            $group = PermissionHelper::getGroupByName($group);
            $groupHasPermissions = $group->hasPermissions($permissions);

            if (!$groupHasPermissions) {
                return JsonFormatter::errors([
                    'message' => "Missing role permissions",
                    'code' => 'missing_role_permissions',
                    'errors' => []
                ], 404);
            }
        }

        return $next($request);
    }
}
