<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $comment_id
 * @property int $user_id
 */
class CommentStar extends Model
{
    protected $table   = 'comment_stars';
    public $timestamps = false;
}
