<?php

namespace App\Console\Commands;

use App\Models\ForumTopic;
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
    protected $signature = 'convert:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $topics = DB::connection('reviews')->select("SELECT forumtopics.* FROM forumtopics");
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
}
