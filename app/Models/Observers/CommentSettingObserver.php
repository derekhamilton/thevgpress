<?php
namespace App\Models\Observers;

use App\Models\CommentSetting;
use Auth;
use RedisL;

class CommentSettingObserver
{
    public function saving(CommentSetting $setting)
    {
        $user = Auth::user();
        if ($user) {
            RedisL::hdel('likes', $setting->comment_id);
            RedisL::hdel('liked-by', "{$setting->comment_id}:{$user->id}");
            return true;
        }
    }
}
