<?php
namespace App\Models;

/**
 * App\Models\Friend
 *
 * @property int $user_id
 * @property int $friend_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Friend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Friend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Friend query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Friend whereFriendId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Friend whereUserId($value)
 * @mixin \Eloquent
 */
class Friend extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'friends';

    public $timestamps = false;
}
