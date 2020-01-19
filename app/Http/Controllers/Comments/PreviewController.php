<?php
namespace App\Http\Controllers\Comments;

/**
 * PageController class
 */

use App\Http\Controllers\PageController;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

/**
 * Top-level controller for displaying pages
 */
final class PreviewController extends PageController
{
    public function show(Request $request)
    {
        $comment                 = new Comment;
        $comment->id             = 0;
        $comment->user_id        = Auth::user()->id;
        $comment->forum_topic_id = $request->input('topicId');
        $comment->comment        = $request->input('comment');
        $comment->created_at     = date('Y-m-d H:i:s');
        $comment->updated_at     = $comment->created_at;
        return view('comment', ['comment' => $comment]);
    }
}
