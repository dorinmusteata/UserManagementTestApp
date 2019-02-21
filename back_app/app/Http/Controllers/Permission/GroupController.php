<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facades\PermissionHelper;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\JsonFormatter;

/**
 * Class GroupController
 * @package App\Http\Controllers\Permission
 */
class GroupController extends Controller
{

    /**
     * GroupController constructor.
     */
    public function __construct()
    {
        $this->middleware('group:groups_admin,view', ['only' => ['index', 'show']]);
        $this->middleware('group:groups_admin,edit', ['only' => ['update']]);
        $this->middleware('group:groups_admin,create', ['only' => ['store']]);
        $this->middleware('group:groups_admin,delete', ['only' => ['destroy']]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'limit' => ['required', 'int', 'min:15', 'max:50'],
            'page' => ['required', 'int', 'min:1'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $query = $request->get('query');
        $search = isset($query) ? $query : '';
        $groups = PermissionHelper::getGroups($search, $request->get('page'), $request->get('limit'));

        return JsonFormatter::data($groups);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $group = PermissionHelper::getGroup($id);

        if (!$group) {
            return JsonFormatter::error_404('Group Not found');
        }

        return JsonFormatter::data($group);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:4', 'max:255', 'unique:groups']
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $group = PermissionHelper::createGroup($request->all());

        return JsonFormatter::data($group);
    }


    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:4', 'max:255']
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $group = PermissionHelper::getGroup($id);

        if (!$group) {
            return JsonFormatter::error_404('Group Not found');
        }

        $updated = PermissionHelper::updateGroup($id, $request->get('name'));

        return JsonFormatter::data($updated);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id) : JsonResponse
    {
        $group = PermissionHelper::getGroup($id);

        if (!$group) {
            return JsonFormatter::error_404('Group Not found');
        }

        PermissionHelper::deleteGroup($id);

        return JsonFormatter::data([], 204);
    }
}
