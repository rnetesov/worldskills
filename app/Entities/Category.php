<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Entities\Category
 *
 * @property int $id
 * @property string $title
 * @property string|null $img
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    public $fillable = ['title'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
