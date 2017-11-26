<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ForumBoard extends Model
{
    use Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_boards';

    /**
     * Forum topics belonging to the forum board
     * @return array
     */
    public function topics()
    {
        return $this->hasMany('App\Models\ForumTopic')
            ->orderBy('last_commented_at', 'desc');
    }

    public function sluggable()
    {
        return [ 'slug' => [ 'source' => 'title' ] ];
    }
}
