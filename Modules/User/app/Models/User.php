<?php

namespace Modules\User\Models;

use App\Models\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Carts\Models\Carts;
use Modules\Email\Models\Email;
use Laravel\Sanctum\HasApiTokens;
use Modules\Blog\Models\Blog;

// use Modules\User\Database\Factories\UserFactory;

class User extends Model
{
    use HasFactory,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'password',
        'role_id',
        'phone',
        'email',
        'expiration_time',  
        'email_verify',

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
    public function email():HasMany
    {  
        return $this->hasMany(Email::class);  
    } 
    public function Bloge():HasMany
    {  
        return $this->hasMany(Blog::class);  
    }
    // protected static function newFactory(): UserFactory
    // {
    //     // return UserFactory::new();
    // }
}
