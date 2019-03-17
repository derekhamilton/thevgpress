<?php
namespace App\Http\Controllers\Comments;

/**
 * PageController class
 */

use App\Services\Save\Comments\SaveService;
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
    public function post(Request $request, SaveService $saveService)
    {
        $text = $request->input('comment');
        $forumTopicId = $request->input('forumTopicId');
        $saveService->save($request);

        return $this->response();
    }
}
