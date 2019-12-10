<?php
namespace App\Http\Controllers\Forum\Topic;

/**
 * Forum Board controller
 */

use App\Handlers\Forum\Topic\ShowHandler;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;

/**
 * Display of topics within a board
 */
class ShowController extends PageController
{
    /**
     * List comments within a given forum topic
     * @param Request     $request
     * @param ShowHandler $handler
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
