<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\CommentSetting;
use App\Models\CommentStar;
use App\Models\ForumTopic;
use App\Models\Friend;
use App\Models\Message;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConvertOldDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:db {--startDate=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Converts the old thevgpress database to the new format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startDate = $this->option('startDate');
        $startDate = is_array($startDate) ? '' : (string)$startDate;
        $this->forumTopics($startDate);
        $this->users($startDate);
        $this->comments($startDate);
        $this->commentStars();
        $this->commentSettings();
        $this->friends();
        $this->messages($startDate);
        $this->news($startDate);
    }

    private function forumTopics(string $startDate)
    {
        $date   = strtotime($startDate);
        $topics = DB::connection('reviews')->select("SELECT forumtopics.* FROM forumtopics WHERE date >= $date");
        foreach ($topics as $oldTopic) {
            $lastComment              = DB::connection('reviews')->select("SELECT comments.date FROM comments WHERE externalID = {$oldTopic->id} AND commentType = 4 ORDER BY comments.date DESC LIMIT 1");
            $lastComment              = $lastComment ? $lastComment[0] : null;
            $topic                    = new ForumTopic;
            $topic->id                = $oldTopic->id;
            $topic->forum_board_id    = $oldTopic->boardID;
            $topic->user_id           = $oldTopic->userID;
            $topic->title             = $oldTopic->title;
            $topic->slug              = Str::slug($oldTopic->title);
            $topic->stickied          = $oldTopic->stickied;
            $topic->locked            = $oldTopic->locked;
            $topic->votes             = $oldTopic->votes;
            $topic->last_commented_at = $lastComment ? date('Y-m-d H:i:s', $lastComment->date) : null;
            $topic->created_at        = date('Y-m-d H:i:s', $oldTopic->date);
            $topic->updated_at        = $topic->created_at;
            $topic->deleted_at        = $oldTopic->isDeleted ? $topic->created_at : null;
            $topic->save();
        }
    }

    private function users(string $startDate)
    {
        $date  = strtotime($startDate);
        $users = DB::connection('reviews')->select("SELECT users.* FROM users WHERE joined >= $date");
        foreach ($users as $oldUser) {
            $user                    = new User;
            $user->id                = $oldUser->id;
            $user->skin_id           = $oldUser->skinID;
            $user->username          = $oldUser->username;
            $user->password          = $oldUser->password;
            $user->email             = $oldUser->email;
            $user->signature         = $oldUser->signature;
            $user->profile           = $oldUser->profile;
            $user->comments_per_page = $oldUser->forumCommentsPerPage;
            $user->bury_votes        = $oldUser->buryVotes;
            $user->use_editor        = $oldUser->useEditor;
            $user->show_avatars      = $oldUser->showAvatars;
            $user->show_stats        = $oldUser->showStats;
            $user->show_signatures   = $oldUser->showSignatures;
            $user->hide_read         = $oldUser->hideRead;
            $user->jump_last_unread  = $oldUser->jumpLastUnread;
            $user->appear_online     = $oldUser->appearOnline;
            $user->country           = $oldUser->country;
            $user->ip                = $oldUser->ip;
            $user->news_visited_at   = date('Y-m-d H:i:s', $oldUser->lastSeen);
            $user->score             = $oldUser->score;
            $user->news_clicks       = $oldUser->newsclicks;
            $user->created_at        = date('Y-m-d H:i:s', $oldUser->joined);
            $user->updated_at        = $user->created_at;
            $user->save();
        }
    }

    private function comments(string $startDate)
    {
        $date     = strtotime($startDate);
        $comments = DB::connection('reviews')->select("SELECT comments.* FROM comments WHERE commentType = 4 AND date >= $date");
        foreach ($comments as $oldComment) {
            if ($oldComment->externalID == -1) {
                continue;
            }

            $comment                 = new Comment;
            $comment->id             = $oldComment->id;
            $comment->user_id        = $oldComment->userID;
            $comment->forum_topic_id = $oldComment->externalID;
            $comment->comment        = $oldComment->comment;
            $comment->created_at     = date('Y-m-d H:i:s', $oldComment->date);
            $comment->updated_at     = $comment->created_at;
            $comment->deleted_at     = $oldComment->isDeleted ? Carbon::now()->toDateTimeString() : null;
            $comment->save();
        }
    }

    private function commentStars()
    {
        $commentStars = DB::connection('reviews')->select("SELECT commentstars.* FROM commentstars");
        foreach ($commentStars as $oldCommentStar) {
            $commentStar             = new CommentStar;
            $commentStar->comment_id = $oldCommentStar->commentID;
            $commentStar->user_id    = $oldCommentStar->userID;
            try {
                $commentStar->save();
            } catch (Exception $e) {
            }
        }
    }

    private function commentSettings()
    {
        $votes = DB::connection('reviews')->select("SELECT votes.* FROM votes");
        foreach ($votes as $vote) {
            $commentSetting             = new CommentSetting;
            $commentSetting->user_id    = $vote->userID;
            $commentSetting->comment_id = $vote->commentID;
            $commentSetting->liked      = $vote->vote > 0 ? 1 : 0;
            $commentSetting->is_hidden  = (bool)$vote->hidden;
            $commentSetting->is_starred = (bool)$vote->starred;
            try {
                $commentSetting->save();
            } catch (Exception $e) {
            }
        }
    }

    private function friends()
    {
        $date    = strtotime($startDate);
        $friends = DB::connection('reviews')->select("SELECT friends.* FROM friends WHERE date >= $date");
        foreach ($friends as $oldFriend) {
            $friend            = new Friend;
            $friend->user_id   = $oldFriend->userID;
            $friend->friend_id = $oldFriend->friendID;
            try {
                $friend->save();
            } catch (Exception $e) {
            }
        }
    }

    private function messages(string $startDate)
    {
        $date     = strtotime($startDate);
        $messages = DB::connection('reviews')->select("SELECT messages.* FROM messages WHERE date >= $date");
        foreach ($messages as $oldMessage) {
            $message                      = new Message;
            $message->id                  = $oldMessage->id;
            $message->user_id_sender      = $oldMessage->senderID;
            $message->user_id_receiver    = $oldMessage->userID;
            $message->title               = $oldMessage->title;
            $message->message             = $oldMessage->text;
            $message->read_at             = $oldMessage->isRead ? Carbon::now()->toDateTimeString() : null;
            $message->created_at          = date('Y-m-d H:i:s', $oldMessage->date);
            $message->updated_at          = $message->created_at;
            $message->receiver_deleted_at = $oldMessage->isDeleted ? Carbon::now()->toDateTimeString() : null;
            $message->save();
        }
    }

    private function news(string $startDate)
    {
        $date = strtotime($startDate);
        $news = DB::connection('reviews')->select("SELECT news.* FROM news WHERE date >= $date");
        foreach ($news as $oldItem) {
            switch ($oldItem->company) {
                case 1:
                    $company = "microsoft"; break;
                case 2:
                    $company = "nintendo"; break;
                case 3:
                    $company = "sony"; break;
                case 4:
                    $company = "pc"; break;
                default:
                    $company = "multiplat"; break;
            }

            $item                 = new News;
            $item->id             = $oldItem->id;
            $item->user_id        = $oldItem->userID;
            $item->title          = $oldItem->title;
            $item->description    = $oldItem->description;
            $item->link           = $oldItem->link;
            $item->company        = $company;
            $item->is_big_news    = $oldItem->bigNews;
            $item->is_news        = $oldItem->news;
            $item->is_media       = $oldItem->media;
            $item->is_impressions = $oldItem->impressions;
            $item->is_editorial   = $oldItem->editorial;
            $item->clicks         = $oldItem->clicks;
            $item->created_at     = date('Y-m-d H:i:s', $oldItem->date);
            $item->updated_at     = $item->created_at;
            $item->deleted_at     = $oldItem->isDeleted ? Carbon::now()->toDateTimeString() : null;
            $item->save();
        }
    }
}
