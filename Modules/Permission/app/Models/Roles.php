<?php

namespace Modules\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// use Modules\Permission\Database\Factories\RolesFactory;

class Roles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title', 
    ];
    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
    public function givePermissionTo(Permission $permission): self  
    {  
        $this->permissions()->syncWithoutDetaching([$permission->id]);  
        return $this;  
    } 
    // protected static function newFactory(): RolesFactory
    // {
    //     // return RolesFactory::new();
    // }
}
