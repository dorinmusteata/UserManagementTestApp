<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\PermissionHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Helpers\JsonFormatter;

/**
 * Class UserGroupController
 * @package App\Http\Controllers\Permission
 */
class UserGroupController extends Controller
{

    /**
     * UserGroupController constructor.
     */
    public function __construct()
    {
        $this->middleware('group:user_groups_admin,view', ['only' => ['index']]);
        $this->middleware('group:user_groups_admin,create,user_group_append', ['only' => ['store']]);
        $this->middleware('group:user_groups_admin,delete', ['only' => ['destroy']]);
    }

    /**
     * @param int $user
     * @param Request $request
     * @return JsonResponse
     */
    public function index(int $user, Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'limit' => ['required', 'int', 'min:15', 'max:50'],
            'page' => ['required', 'int', 'min:1'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $getUser = PermissionHelper::getUser($user);

        if (!$getUser) {
            return JsonFormatter::error_404('User Not found');
        }

        $groups = PermissionHelper::getUserGroups($user, $request->get('page'), $request->get('limit'));

        return JsonFormatter::data($groups);
    }

    /**
     * @param int $user
     * @param Request $request
     * @return JsonResponse
     */
    public function store(int $user, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'group' => ['required', 'int', 'min:1'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $group = PermissionHelper::getGroup($request->get('group'));
        $getUser = PermissionHelper::getUser($user);

        if (!$group || !$getUser) {
            return JsonFormatter::error_404('Not found');
        }

        $group = PermissionHelper::createUserGroup($user, $request->get('group'));

        return JsonFormatter::data($group);
    }

    /**
     * @param int $user
     * @param int $group
     * @return JsonResponse
     */
    public function destroy(int $user, int $group)
    {

        $getGroup = PermissionHelper::getGroup($group);
        $getUser = PermissionHelper::getUser($user);

        if (!$getGroup || !$getUser) {
            return JsonFormatter::error_404('Not found');
        }

        PermissionHelper::deleteUserGroup($user, $group);

        return JsonFormatter::data([], 204);
    }
}
