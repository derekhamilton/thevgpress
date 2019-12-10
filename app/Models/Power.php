<?php
namespace App\Models;

/**
 * App\Models\Power
 *
 * @property int                        $id
 * @property string                     $key
 * @property string                     $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null                $deleted_at
 * @property-read \App\Models\Group $groups
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Power whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Power extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'powers';

    public function groups()
    {
        return $this->belongsTo(Group::class);
    }
}
