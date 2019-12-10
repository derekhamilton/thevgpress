<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ForumTopicRead
 *
 * @property int                        $id
 * @property int                        $user_id
 * @property int                        $forum_topic_id
 * @property int                        $views
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null                $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereForumTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ForumTopicRead whereViews($value)
 * @mixin \Eloquent
 */
class ForumTopicRead extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_topics_read';

    protected $fillable = ['user_id', 'forum_topic_id'];
}
