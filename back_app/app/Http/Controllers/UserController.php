<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Facades\PermissionHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\JsonFormatter;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('group:users_admin,view', ['only' => ['index', 'show']]);
        $this->middleware('group:users_admin,edit', ['only' => ['update']]);
        $this->middleware('group:users_admin,create', ['only' => ['store']]);
        $this->middleware('group:users_admin,delete', ['only' => ['destroy']]);
    }

    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'limit' => ['required', 'int', 'min:15', 'max:50'],
            'page' => ['required', 'int', 'min:1'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $users = PermissionHelper::getUsers($request->get('page'), $request->get('limit'));

        return JsonFormatter::data($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = PermissionHelper::getUser($id);

        if (!$user) {
            return JsonFormatter::error_404('User Not found');
        }

        return JsonFormatter::data($user);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $user = PermissionHelper::createUser($request->all());

        return JsonFormatter::data(compact('user'));
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return JsonFormatter::error_validation($validator->errors());
        }

        $user = PermissionHelper::getUser($id);

        if (!$user) {
            return JsonFormatter::error_404('User Not found');
        }

        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ];

        PermissionHelper::updateUser($id, $data);

        return JsonFormatter::data([], 204);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = PermissionHelper::getUser($id);

        if (!$user) {
            return JsonFormatter::error_404('User Not found');
        }

        PermissionHelper::deleteUser($id);

        return JsonFormatter::data([], 204);
    }


    public function getAuthenticatedUser(): JsonResponse
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

        return JsonFormatter::data(compact('user'));
    }
}
