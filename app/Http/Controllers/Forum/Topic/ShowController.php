<?php
namespace App\Http\Controllers\Forum\Topic;

/**
 * Forum Board controller
 */

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Config\Repository as Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Repositories\ForumTopicRepository;

/**
 * Display of topics within a board
 */
class ShowController extends PageController
{
    /**
     * List comments within a given forum topic
     * @param string               $boardSlug
     * @param string               $topicSlug
     * @param Request              $request
     * @param Configuration        $config
     * @param ForumTopicRepository $topicRepo
     * @return \Illuminate\View\View
     */
    public function show(
        $boardSlug,
        $topicSlug,
        Request $request,
        Configuration $config,
        ForumTopicRepository $topicRepo
    ) {
        //$topic = ForumTopic::where('slug', $topicSlug)->first();
        $page = $request->input('page');
        $perPage = $config->get('site.comments_per_page');
        $topic = $topicRepo->findBySlug($topicSlug);
        $topicRepo->viewed($this->user, $topic, $page, $perPage);
        $comments = $topic->comments()->paginate($perPage);

        if (is_null($topic)) {
            abort(404);
        }

        return view(
            'forum-topic',
            [
                'topic' => $topic,
                'comments' => $comments
            ]
        );
    }
}
