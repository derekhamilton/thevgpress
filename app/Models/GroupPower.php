<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GroupPower
 *
 * @property int $group_id
 * @property int $power_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupPower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupPower newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupPower query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupPower whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GroupPower wherePowerId($value)
 * @mixin \Eloquent
 */
class GroupPower extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_power';
}
