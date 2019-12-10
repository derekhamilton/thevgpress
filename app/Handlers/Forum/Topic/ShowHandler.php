<?php
namespace App\Handlers\Forum\Topic;

use App\Contracts\Handler;
use App\Exceptions\Forum\Topic\TopicNotFoundException;
use App\Queries\Forum\Topic\FindBySlug;
use App\Queries\Forum\Topic\MarkAsViewed;
use Illuminate\Config\Repository as Configuration;
use Illuminate\Contracts\Auth\Guard as Authentication;
use Illuminate\Http\Request;

class ShowHandler implements Handler
{
    public function __construct(
        Authentication $auth,
        Configuration $config,
        FindBySlug $findBySlug,
        MarkAsViewed $markAsViewed
    ) {
        $this->user         = $auth->user();
        $this->config       = $config;
        $this->findBySlug   = $findBySlug;
        $this->markAsViewed = $markAsViewed;
    }

    /**
     * List comments within a given forum topic
     * @throws TopicNotFoundException
     * @param Request $request
     */
    public function handle(Request $request) : \Illuminate\View\View
    {
        $topicSlug = $request->route('topic');
        $topic     = $this->findBySlug->query($topicSlug);

        if (is_null($topic)) {
            throw new TopicNotFoundException($topicSlug);
        }

        $page    = $request->input('page');
        $perPage = $this->config->get('site.comments_per_page');

        if ($this->user) {
            $this->markAsViewed->query($this->user, $topic, $page, $perPage);
        }

        $comments = $topic->comments()->paginate($perPage);

        return view(
            'forum-topic',
            [
                'topic'    => $topic,
                'comments' => $comments
            ]
        );
    }
}
