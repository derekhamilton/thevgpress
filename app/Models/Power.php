<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Power extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'powers';

    public function groups()
    {
        return $this->belongsTo('Group');
    }
}
