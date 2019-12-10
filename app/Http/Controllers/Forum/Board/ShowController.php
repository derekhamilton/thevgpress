<?php
namespace App\Http\Controllers\Forum\Board;

/**
 * Forum Board controller
 */

use App\Http\Controllers\PageController;
use App\Queries\Forum\Board\FindBySlug;
use View;

/**
 * Display of topics within a board
 */
class ShowController extends PageController
{
    /**
     * List forum topics within a particular forum board
     * @param FindBySlug $findBySlug
     * @param string     $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show(FindBySlug $findBySlug, $slug)
    {
        $board = $findBySlug->query($slug);

        if (is_null($board)) {
            abort(404);
        }

        return View::make(
            'forum-board',
            [
                'board' => $board,
            ]
        );
    }
}
