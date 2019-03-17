<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumBoard extends Model
{
    const GAMING_DISCUSSION     = 1;
    const NON_GAMING_DISCUSSION = 2;
    const BLOGS                 = 3;
    const PODCASTS              = 4;

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
    public function topics(): HasMany
    {
        return $this->hasMany('App\Models\ForumTopic')
            ->orderBy('last_commented_at', 'desc');
    }

    public function sluggable(): array
    {
        return [ 'slug' => [ 'source' => 'title' ] ];
    }
}
