<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $with = [
        'permissions'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'group_permissions')->withTimestamps();
    }

    public function hasPermissions(array $permissions): bool
    {
        $pass = [];

        foreach ($permissions as $permission) {
            if ($this->permissions->contains('name', $permission)) {
                $pass[] = true;
            } else {
                $pass[] = false;
            }
        }

        $passed = in_array(false, $pass, true);

        return ($passed) ? false : true;
    }
}
