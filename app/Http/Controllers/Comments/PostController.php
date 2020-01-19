<?php
namespace App\Http\Controllers\Comments;

/**
 * PageController class
 */

use App\Http\Controllers\PageController;
use App\Models\Comment;
use App\Services\Save\Comments\SaveService;
use Illuminate\Http\Request;

/**
 * Top-level controller for displaying pages
 */
final class PostController extends PageController
{
    /**
     * Store a posted comment
     * @param Request     $request
     * @param SaveService $saveService
     */
    public function post(Request $request, SaveService $saveService)
    {
        $text         = $request->input('comment');
        $forumTopicId = $request->input('forumTopicId');
        $saveService->save($request);

        return $this->response();
    }
}
