<?php
namespace App\Http\Controllers\Forum\Topic;

/**
 * Forum Board controller
 */

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Handlers\Forum\Topic\ShowHandler;

/**
 * Display of topics within a board
 */
class ShowController extends PageController
{
    /**
     * List comments within a given forum topic
     */
    public function show(
        Request $request,
        ShowHandler $handler
    ) : \Illuminate\View\View {
        try {
            return $handler->handle($request);
        } catch (TopicNotFoundException $e) {
            abort(404);
        }
    }
}
