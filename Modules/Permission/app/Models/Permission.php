<?php

namespace Modules\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// use Modules\Permission\Database\Factories\PermissionFactory;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',  
        'label',  
    ];
    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Roles::class,'permission_role', 'permission_id', 'role_id');
    }

    // protected static function newFactory(): PermissionFactory
    // {
    //     // return PermissionFactory::new();
    // }
}
