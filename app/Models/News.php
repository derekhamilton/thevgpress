<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'link',
        'company',
        'is_big_news',
        'is_news',
        'is_media',
        'is_impressions',
        'is_editorial',
        'clicks',
    ];

    public function user(): ?\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
