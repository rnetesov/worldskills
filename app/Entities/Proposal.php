<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    const STATUS_NEW = 1;
    const STATUS_SOLVED = 2;
    const STATUS_WORK = 3;

    public $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'status',
        'photo_before',
        'photo_after',
        'comment'
    ];

    public function isNew()
    {
        return $this->status == Proposal::STATUS_NEW;
    }

    public function isSolved()
    {
        return $this->status == Proposal::STATUS_SOLVED;
    }

    public function isWork()
    {
        return $this->status == Proposal::STATUS_WORK;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
