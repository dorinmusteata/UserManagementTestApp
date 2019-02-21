<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\PermissionHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Helpers\JsonFormatter;

/**
 * Class GroupPermissionController
 * @package App\Http\Controllers\Permission
 */
class GroupPermissionController extends Controller
{

    /**
     * GroupPermissionController constructor.
     */
    public function __construct()
    {
        $this->middleware('group:groups_permissions_admin,view', ['only' => ['index']]);
        $this->middleware('group:groups_permissions_admin,create,permission_group_append', ['only' => ['store']]);
        $this->middleware('group:groups_permissions_admin,delete', ['only' => ['destroy']]);
    }

    /**
     * @param int $group
     * @param Request $request
     * @return JsonResponse
     */
    public function index(int $group, Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'limit' => ['required', 'int', 'min:15', 'max:50'],
            'page' => ['required', 'int', 'min:1'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $getGroup = PermissionHelper::getGroup($group);

        if (!$getGroup) {
            return JsonFormatter::error_404('Group Not found');
        }

        $permissions = PermissionHelper::getGroupPermissions($group, $request->get('page'), $request->get('limit'));

        return JsonFormatter::data($permissions);
    }

    /**
     * @param int $group
     * @param Request $request
     * @return JsonResponse
     */
    public function store(int $group, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'array', 'min:1'],
            "name.*" => ['required', 'string', 'distinct', 'min:4'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $getGroup = PermissionHelper::getGroup($group);

        if (!$getGroup) {
            return JsonFormatter::error_404('Group Not found');
        }

        $permissions = PermissionHelper::createGroupPermission($group, $request->get('name'));

        return JsonFormatter::data($permissions);
    }

    /**
     * @param int $group
     * @param int $permission
     * @return JsonResponse
     */
    public function destroy(int $group, int $permission) : JsonResponse
    {

        $getGroup = PermissionHelper::getGroup($group);
        $getPermission = PermissionHelper::getPermission($permission);

        if (!$getGroup || !$getPermission) {
            return JsonFormatter::error_404('Not found');
        }

        PermissionHelper::deleteGroupPermission($group, $permission);

        return JsonFormatter::data([], 204);
    }
}
