<?php
namespace App\Http\Controllers\Forum\Board;

/**
 * Forum Board controller
 */

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\ForumBoardRepository;
use App\Http\Controllers\PageController;

/**
 * Display of topics within a board
 */
class ShowController extends PageController
{
    /**
     * List forum topics within a particular forum board
     * @param ForumBoardRepository $boardRepo
     * @param string               $slug
     * @return \Illuminate\View\View
     */
    public function show(ForumBoardRepository $boardRepo, $slug)
    {
        $board = $boardRepo->findBySlug($slug);

        if (is_null($board)) {
            abort(404);
        }

        return view(
            'forum-board',
            [
                'board' => $board,
            ]
        );
    }
}
