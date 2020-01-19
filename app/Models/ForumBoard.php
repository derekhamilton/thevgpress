<?php
namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ForumBoard
 *
 * @property int                        $id
 * @property string                     $title
 * @property string                     $slug
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null                $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ForumTopic[] $topics
 * @property-read int|null $topics_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumBoard whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
