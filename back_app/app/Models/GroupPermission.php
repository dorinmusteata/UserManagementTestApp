<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id', 'group_id'
    ];

    public function permission() {
        return $this->hasOne(Permission::class);
    }

    public function group() {
        return $this->hasOne(Group::class);
    }
}
