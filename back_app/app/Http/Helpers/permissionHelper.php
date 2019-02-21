<?php

namespace App\Http\Helpers;

use App\Models\Group;
use App\Models\GroupPermission;
use App\Models\Permission;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class permissionHelper
 * @package App\Http\Helpers
 */
class permissionHelper
{

    /**
     * @param string $query
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function getGroups(string $query = '', int $page = 1, int $limit = 1): Collection
    {
        return Group::where('name', 'LIKE', "%$query%")
            ->skip($this->skipPage($page, $limit))
            ->limit($limit)
            ->get();
    }

    /**
     * @param array $data
     * @return object
     */
    public function createGroup(array $data): object
    {
        return Group::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return array
     */
    public function createGroupPermission($id, array $data)
    {
        $sync = [];
        $permissions = [];
        $group = $this->getGroup($id);

        foreach ($data as $name) {
            $permission = Permission::updateOrCreate([
                'name' => $name
            ]);
            $sync[] = $permission->id;
            $permissions[] = $permission;
        }

        $group->permissions()->sync($sync);

        return $permissions;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getGroup($id)
    {
        return Group::find($id);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getGroupByName(string $name)
    {
        return Group::where('name', $name)->first();
    }

    /**
     * @param int $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getGroupPermissions(int $id, int $page = 1, int $limit = 15)
    {
        $group = $this->getGroup($id);

        return $group->permissions()->skip($this->skipPage($page, $limit))->limit($limit)->get();
    }

    /**
     * @param int $id
     * @param string $name
     * @return Group
     */
    public function updateGroup(int $id, string $name): Group
    {
        $group = Group::find($id);

        $group->name = $name;

        $group->save();

        return $group;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteGroup(int $id)
    {
        return Group::find($id)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPermission(int $id)
    {
        return Permission::find($id);
    }

    /**
     * @param int $id
     * @param int $permission
     * @return int
     */
    public function deleteGroupPermission(int $id, int $permission): int
    {
        $group = $this->getGroup($id);

        return $group->permissions()->detach($permission);
    }

    /**
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function getUsers(int $page = 1, int $limit = 15): Collection
    {
        return User::skip($this->skipPage($page, $limit))->limit($limit)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        return User::find($id);
    }

    /**
     * @param array $data
     * @return object
     */
    public function createUser(array $data): object
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateUser(int $id, array $data): bool
    {
        return User::find($id)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteUser(int $id)
    {
        return User::find($id)->delete();
    }

    /**
     * @param int $id
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getUserGroups(int $id, int $page = 1, int $limit = 15)
    {
        $user = $this->getUser($id);

        return $user->groups()->skip($this->skipPage($page, $limit))->limit($limit)->get();
    }

    /**
     * @param int $id
     * @param int $group
     * @return int|mixed
     */
    public function createUserGroup(int $id, int $group)
    {
        $user = $this->getUser($id);
        $group = $this->getGroup($group);

        if (!$user->groups->contains($group)) {
            $user->groups()->save($group);
        }

        return $group;
    }

    /**
     * @param int $page
     * @param int $limit
     * @return int
     */
    public function skipPage(int $page = 1, int $limit = 15): int
    {
        return ($page == 1) ? 0 : (($page - 1) * $limit);
    }

    /**
     * @param int $id
     * @param int $group
     * @return int
     */
    public function deleteUserGroup(int $id, int $group): int
    {
        $user = $this->getUser($id);

        return $user->groups()->detach($group);
    }
}
