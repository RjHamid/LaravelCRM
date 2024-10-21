<?php

namespace Modules\Comments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Models\User;

// use Modules\Comments\Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory;


    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $guarded = [];



    /*public function user()
    {
        return $this->belongsTo()
    }*/
}
