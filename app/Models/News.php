<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property int                        $id
 * @property int                        $user_id
 * @property string                     $title
 * @property string|null                $description
 * @property string|null                $link
 * @property string|null                $company
 * @property int                        $is_big_news
 * @property int                        $is_news
 * @property int                        $is_media
 * @property int                        $is_impressions
 * @property int                        $is_editorial
 * @property int                        $clicks
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null                $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsBigNews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsEditorial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsImpressions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereIsNews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\News whereUserId($value)
 * @mixin \Eloquent
 */
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
