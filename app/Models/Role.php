<?php

namespace App\Models;
use App\Models\Permissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];
    public function permissions(){
        return $this->belongsToMany(Permissions::class,'role_permissions');
    }
}
