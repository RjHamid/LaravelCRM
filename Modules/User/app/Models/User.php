<?php

namespace Modules\User\Models;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Carts\Models\Carts;

// use Modules\User\Database\Factories\UserFactory;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'password',
        'role_id',
        'phone',
        'email',

    ];
        /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    public function roles(): HasMany 
    {  
        return $this->hasMany(Roles::class);  
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Carts::class);
    }

    // protected static function newFactory(): UserFactory
    // {
    //     // return UserFactory::new();
    // }
}
