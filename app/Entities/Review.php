<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $fillable = [
        'photo',
        'comment',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
