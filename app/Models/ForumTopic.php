<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class ForumTopic extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_topics';

    /**
     * User who created the topic
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Forum Topic comments
     *
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * The OP comment in a forum topic
     *
     * @return Comment
     */
    public function firstComment()
    {
        $comments = $this->comments();
        return $comments
            ? $comments->orderBy('created_at', 'desc')->take(1)->first()
            : null;
    }

    /**
     * The most recent comment in a forum topic
     *
     * @return Comment
     */
    public function lastComment()
    {
        $comments = $this->comments();
        return $comments
            ? $comments->orderBy('created_at')->take(1)->first()
            : null;
    }

    /**
     * Comments not not having been seen by the user yet
     *
     * @return mixed
     */
    public function unread($userId = null)
    {
        if (!$userId) {
            return $this->comments();
        }

        return $this->hasMany('App\Models\ForumTopicRead')
            ->where('user_id', $userId);
    }

    /**
     * Total number of likes
     *
     * @param bool  $formatted  whether to include positive sign if positive
     * @return mixed
     */
    public function likes($formatted = false)
    {
        return $this->firstComment()->likes($formatted);
    }

    /**
     * If comments are numbered incrementally, the highest number visible on the current page
     *
     * @param int   $page
     * @param int   $perPage
     * @return int
     */
    public function lastCommentVisible($page, $perPage)
    {
        if (!$page) {
            $page = 1;
        }

        $max = $page * $perPage;
        $total = $this->comments()->count();
        return $total < $max ? $total : $max;
    }
}
