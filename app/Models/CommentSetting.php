<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommentSetting
 *
 * @property int                        $id
 * @property int                        $user_id
 * @property int                        $comment_id
 * @property int                        $liked
 * @property int                        $is_hidden
 * @property int                        $is_starred
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereIsStarred($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereLiked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CommentSetting whereUserId($value)
 * @mixin \Eloquent
 */
class CommentSetting extends Model
{
    protected $fillable = [ 'user_id', 'comment_id' ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment_settings';

    public static function get($userId, $commentId)
    {
        $setting = CommentSetting::where('user_id', $userId)
            ->where('comment_id', $commentId)
            ->first();

        if (is_null($setting)) {
            $setting = new CommentSetting;
        }

        $setting->user_id    = $userId;
        $setting->comment_id = $commentId;

        return $setting;
    }
}
