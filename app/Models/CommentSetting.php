<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

        $setting->user_id = $userId;
        $setting->comment_id = $commentId;

        return $setting;
    }
}
