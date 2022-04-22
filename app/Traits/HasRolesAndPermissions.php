<?php
namespace app\Traits;

use App\Models\Permission;
use App\Models\Role;
trait HasRolesAndPermissions

{
    public function roles(){
        return $this->belongsToMany(Role::class,'users_roles');
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class,'users_permissions');
    }
}
