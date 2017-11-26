<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
