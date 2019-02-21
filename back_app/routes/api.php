<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @api {post} /register Register user
 * @apiName RegisterUser
 * @apiGroup Auth
 *
 * @apiParam {String{4}} name User name
 * @apiParam {String{4}} email User email
 * @apiParam {String{6}} password User password
 * @apiParam {String{6}} password_confirmation User password
 *
 * @apiSuccess {Object} user User object.
 * @apiSuccess {String} token User token.
 *
 * @apiError not_found
 * @apiError validation_failed
 * @apiError missing_role
 * @apiError missing_role_permissions
 */

Route::post('register', 'Auth\RegisterController@register');

/**
 * @api {post} /login Login user
 * @apiName LoginUser
 * @apiGroup Auth
 *
 * @apiParam {String{4}} email User email
 * @apiParam {String{6}} password User password
 *
 * @apiSuccess {Object} user User object.
 * @apiSuccess {String} token User token.
 *
 * @apiError not_found
 * @apiError validation_failed
 * @apiError missing_role
 * @apiError missing_role_permissions
 */

Route::post('login', 'Auth\LoginController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::group(['middleware' => ['group:user']], function () {

        /**
         * @api {get} /user Request current user
         * @apiName GetCurrentUser
         * @apiGroup Auth
         *
         * @apiSuccess {Object} user User object.
         *
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        Route::get('user', 'UserController@getAuthenticatedUser');

        /**
         * @api {get} /groups Request groups list
         * @apiName GetGroups
         * @apiGroup Group
         *
         * @apiParam {Number{1}} page Page number
         * @apiParam {Number{15}} limit List limit
         *
         * @apiSuccess {Object[]} group List of groups.
         *
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {post} /groups Create group
         * @apiName CreateGroup
         * @apiGroup Group
         *
         * @apiParam {String{4}} name Group name
         *
         * @apiSuccess {Object} group object
         *
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {put} /groups/:id Update group
         * @apiName UpdateGroup
         * @apiGroup Group
         *
         * @apiParam {Number} id Group unique ID
         *
         * @apiSuccess {Object} group object
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {delete} /groups/:id Delete group
         * @apiName DeleteGroup
         * @apiGroup Group
         *
         * @apiParam {Number} id Group unique ID
         *
         * @apiSuccess (204) Success
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {get} /groups/:group/permissions Request group permissions list
         * @apiName GetGroupPermissions
         * @apiGroup GroupPermission
         *
         * @apiParam {Number} group Group unique ID
         * @apiParam {Number{1}} page Page number
         * @apiParam {Number{15}} limit List limit
         *
         * @apiSuccess {Object[]} permission List of group permissions.
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {post} /groups/:group/permissions Create or update group permissions
         * @apiName CreateUpdateGroupPermission
         * @apiGroup GroupPermission
         *
         * @apiParam {Number} group Group unique ID
         * @apiParam {Array{1}} name Group permissions names
         *
         * @apiSuccess {Object[]} permission List of group permissions.
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {delete} /groups/:group/permissions/:permission Delete group permission
         * @apiName DeleteGroupPermission
         * @apiGroup GroupPermission
         *
         * @apiParam {Number} group Group unique ID
         * @apiParam {Number} permission Permission unique ID
         *
         * @apiSuccess (204) Success
         *
         * @apiError not_found
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {get} /users Request users list
         * @apiName GetUsers
         * @apiGroup User
         *
         * @apiParam {Number{1}} page Page number
         * @apiParam {Number{15}} limit List limit
         *
         * @apiSuccess {Object[]} user List of users.
         *
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {post} /users Create user
         * @apiName CreateUser
         * @apiGroup User
         *
         * @apiParam {String{4}} name User name
         * @apiParam {String{4}} email User email
         * @apiParam {String{6}} password User password
         * @apiParam {String{6}} password_confirmation User password
         *
         * @apiSuccess {Object} user object
         *
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {put} /users/:id Update user
         * @apiName UpdateUser
         * @apiGroup User
         *
         * @apiParam {String{4}} name User name
         * @apiParam {String{4}} email User email
         *
         * @apiSuccess (204) Success
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {delete} /users/:id Delete user
         * @apiName DeleteUser
         * @apiGroup User
         *
         * @apiParam {Number} id User unique ID
         *
         * @apiSuccess (204) Success
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {get} /users/:user/groups Request user groups list
         * @apiName GetUserGroups
         * @apiGroup UserGroups
         *
         * @apiParam {Number} user User unique ID
         * @apiParam {Number{1}} page Page number
         * @apiParam {Number{15}} limit List limit
         *
         * @apiSuccess {Object[]} group List of user groups.
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {post} /users/:user/groups Create or update user groups
         * @apiName CreateUpdateUserGroup
         * @apiGroup UserGroups
         *
         * @apiParam {Number} user User unique ID
         *
         * @apiSuccess {Object} group Group object.
         *
         * @apiError not_found
         * @apiError validation_failed
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        /**
         * @api {delete} /users/:user/groups/:group Delete user group
         * @apiName DeleteUserGroup
         * @apiGroup UserGroups
         *
         * @apiParam {Number} user User unique ID
         * @apiParam {Number} group Group unique ID
         *
         * @apiSuccess (204) Success
         *
         * @apiError not_found
         * @apiError missing_role
         * @apiError missing_role_permissions
         */

        Route::resources([
            'groups' => 'Permission\GroupController',
            'groups.permissions' => 'Permission\GroupPermissionController',
            'users' => 'UserController',
            'users.groups' => 'Permission\UserGroupController'
        ]);

    });

});
