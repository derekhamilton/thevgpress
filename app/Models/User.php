<?php
namespace App\Models;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Validator;

/**
 * App\Models\User
 *
 * @property int                        $id
 * @property int                        $skin_id
 * @property string                     $username
 * @property string                     $password
 * @property string|null                $reset_token
 * @property string|null                $reset_time
 * @property string|null                $email
 * @property string|null                $signature
 * @property string|null                $profile
 * @property int                        $comments_per_page
 * @property int                        $bury_votes
 * @property int                        $sticky_menu
 * @property int                        $menu_dropdowns
 * @property int                        $use_editor
 * @property int                        $show_avatars
 * @property int                        $show_stats
 * @property int                        $show_signatures
 * @property int                        $hide_read
 * @property int|null                   $jump_last_unread
 * @property int|null                   $appear_online
 * @property string                     $country
 * @property string                     $ip
 * @property string|null                $news_visited_at
 * @property int                        $score
 * @property int                        $news_clicks
 * @property string|null                $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null                $deleted_at
 * @property-read \App\Models\Group $groups
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAppearOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBuryVotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCommentsPerPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHideRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereJumpLastUnread($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMenuDropdowns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewsClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNewsVisitedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereResetTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereShowAvatars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereShowSignatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereShowStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSkinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStickyMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUseEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * The attributes autofillable from the join form
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'email'];

    /** used for validation, not to be stored in database */
    public $password_confirmation = null;

    /**
     * The groups the user belongs to
     * @return mixed
     */
    public function groups()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * The powers the user has
     * @return Builder
     */
    public function powers()
    {
        $groupIds = GroupUser::where('user_id', $this->id)
            ->pluck('group_id')
            ->toArray();

        // array(-1) fallback since in whereIn will fail against empty array
        // still want to add to query builder to allow chaining
        $powerIds = GroupPower::whereIn('group_id', $groupIds ?: [-1])
            ->pluck('power_id')
            ->toArray();

        return Power::whereIn('id', $powerIds ?: [-1]);
    }

    /**
     * If the user has a power with the given key
     * @return bool
     * @param mixed $key
     */
    public function hasPower($key)
    {
        return in_array($key, $this->powers()->pluck('key')->toArray());
    }

    /**
     * List of conversations
     *
     * A conversation is the connection between two users where one user
     * has sent or received a message from another user
     *
     * @return array
     */
    public function conversations()
    {
        return $this->startedConversations()
            ->union($this->receivedConversations())
            ->get();
    }

    /**
     * Total comments posted by the user
     * @return int
     */
    public function commentCount()
    {
        return $this->hasMany('App\Models\Comment')->count();
    }

    /**
     * Total news posts by the user
     * @return int
     */
    public function newsCount()
    {
        return $this->hasMany('App\Models\News')->count();
    }

    /**
     * Placement on the high score leaderboard
     * @return int
     */
    public function rank()
    {
        // add 1 since if there's 1 person ahead of you, you're second
        return self::where('score', '>', $this->score)->count() + 1;
    }

    /**
     * Conversations created by the given user sending a message
     * @return array
     */
    public function startedConversations()
    {
        // list of users with which the logged in user has conversations
        // Using DB::table so we can use union in the conversations() function
        return DB::table('users')
            ->select('users.id', 'username')
            ->join('messages', 'users.id', '=', 'messages.user_id_sender')
            ->where('user_id_receiver', $this->id)
            ->groupBy('users.id')
            ->orderBy('messages.created_at', 'desc');
    }

    /**
     * Conversations created by the given user receiving a message
     * @return array
     */
    public function receivedConversations()
    {
        // must count users who logged in user has received a message from
        // but has not messaged. Using DB::table so we can use union
        // in the conversations() function
        return DB::table('users')
            ->select('users.id', 'username')
            ->join('messages', 'users.id', '=', 'messages.user_id_sender')
            ->where('user_id_receiver', $this->id)
            ->groupBy('users.id')
            ->orderBy('messages.created_at', 'desc');
    }

    /**
     * Validate User data - used in Observer
     * @return mixed
     */
    public function validate()
    {
        $rules = [
            'username' => 'required|alpha_dash|max:30',
            'password' => 'required|min:6|confirmed',
            'email'    => 'email'
        ];

        if (!$this->id) {
            $rules['username'] .= '|unique:users';
        }

        $data                          = $this->toArray();
        $data['password_confirmation'] = $this->id ? $this->password : $this->password_confirmation;
        $validator                     = Validator::make(
            $data,
            $rules
        );

        if ($validator->fails()) {
            return $validator->messages();
        }

        return true;
    }

    public function liked($commentId)
    {
        return !is_null(
            CommentSetting::where('liked', 1)
                ->where('user_id', $this->id)
                ->where('comment_id', $commentId)
                ->first()
        );
    }
}
