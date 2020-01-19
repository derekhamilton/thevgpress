<?php
namespace App\Http\Controllers\Comments;

/**
 * PageController class
 */

use App\Http\Controllers\PageController;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Top-level controller for displaying pages
 */
final class LikeController extends PageController
{
    /**
     * Save a like
     * @param Request $request
     * @return string
     */
    public function post(Request $request)
    {
        $liked   = $request->input('liked');
        $comment = Comment::find($request->input('commentId'));

        if (is_null($comment)) {
            throw new \App\Exceptions\CommentNotFoundException;
        }

        $liked ? $comment->like() : $comment->unlike();
        return $comment->likes(true);
    }
}
