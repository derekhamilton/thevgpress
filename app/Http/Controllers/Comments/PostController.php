<?php
namespace App\Http\Controllers\Comments;

/**
 * PageController class
 */

use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Models\Comment;

/**
 * Top-level controller for displaying pages
 */
final class PostController extends PageController
{
    /**
     * Store a posted comment
     */
    public function post(Request $request)
    {
        $text = $request->input('comment');
        $forumTopicId = $request->input('forumTopicId');

        Comment::add($text, $forumTopicId);

        return $this->response();
    }
}
