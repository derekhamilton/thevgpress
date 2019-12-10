<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GroupUser
 *
 * @property int $group_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupUser whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupUser whereUserId($value)
 * @mixin \Eloquent
 */
class GroupUser extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_user';
}
