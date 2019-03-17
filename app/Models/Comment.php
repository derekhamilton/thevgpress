<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use RedisL;
use Validator;

class Comment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $fillable = ['id', 'user_id', 'forum_topic_id', 'comment'];

    /**
     * User who created the comment
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Number of likes for the comment
     *
     * @param bool  $formatted
     * @return mixed
     */
    public function likes($formatted=false)
    {
        $likes = RedisL::hget('likes', $this->id);
        if (!is_null($likes)) {
            return $formatted ? $this->formatLikes($likes) : $likes;
        }

        $likes = $this->hasMany('App\Models\CommentSetting')->sum('liked');

        RedisL::hset('likes', $this->id, $likes);
        return $formatted ? $this->formatLikes($likes) : $likes;
    }

    /**
     * Format like count for output with positive sign
     *
     * @param int   $likes
     * @return string
     */
    private function formatLikes($likes)
    {
        return ($likes > 0 ? '+' : '').$likes;
    }

    /**
     * Set the comment like
     */
    public function like()
    {
        $user = Auth::user();
        RedisL::hset('liked-by', "{$this->id}:{$user->id}", 1);
        $setting = CommentSetting::get(Auth::user()->id, $this->id);
        $setting->liked = 1;
        $setting->save();
    }

    /**
     * Unset the comment like
     */
    public function unlike()
    {
        $user = Auth::user();
        RedisL::hset('liked-by', "{$this->id}:{$user->id}", 0);
        $setting = CommentSetting::get(Auth::user()->id, $this->id);
        $setting->liked = 0;
        $setting->save();
    }

    /**
     * If a comment is liked by a particular user
     *
     * @param int   $userId
     * @return bool
     */
    public function likedBy($userId)
    {
        $likedBy = RedisL::hget('liked-by', "{$this->id}:$userId");
        if (!is_null($likedBy)) {
            return $likedBy;
        }

        $setting = CommentSetting::where('user_id', $userId)
            ->where('comment_id', $this->id)
            ->first();

        if (is_null($setting)) {
            return false;
        }

        $likedBy = intval($setting->liked) === 1;
        RedisL::hset('liked-by', "{$this->id}:$userId", $likedBy);
        return $likedBy;
    }

    /**
     * Create a new comment
     *
     * @param string    $text
     * @param id        $forumTopicId
     */
    public static function add($text, $forumTopicId=null)
    {
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->forum_topic_id = $forumTopicId ?: null;
        $comment->comment = $text;
        $comment->save();
    }

    /**
     * Validate User data - used in Observer
     * @return mixed
     */
    public function validate()
    {
        $rules = array(
            'user_id' => 'numeric|required',
            'forum_topic_id' => 'numeric|nullable',
            'comment'    => 'required'
        );

        $data = $this->toArray();

        $validator = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }
}
