<?php

namespace App\Http\Traits;

use App\Models\Group;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions
{

    public function groups() : BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_groups')->withTimestamps();
    }

    public function hasGroup(string $group): bool
    {
        if ($this->groups->contains('name', $group)) {
            return true;
        }
        return false;
    }

    protected function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionGroup($permission);
    }

    protected function hasPermission(Permission $permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasPermissionGroup($permission)
    {
        foreach ($permission->groups as $group) {
            if ($this->groups->contains($group)) {
                return true;
            }
        }
        return false;
    }

    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }


}
