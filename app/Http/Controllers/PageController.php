<?php
namespace App\Http\Controllers;

/**
 * PageController class
 */

use App\Alerts\Alert;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\View\Factory as View;
use Redirect;

/**
 * Top-level controller for displaying pages
 */
class PageController extends BaseController
{
    protected $user;
    protected $request;
    protected $alert;

    /**
     * default constructor
     * @param AuthManager $auth
     * @param Request     $request
     * @param View        $view
     * @param Alert       $alert
     */
    public function __construct(AuthManager $auth, Request $request, View $view, Alert $alert)
    {
        $this->alert   = $alert;
        $this->request = $request;
        $this->middleware(function ($request, $next) use ($auth, $view, $alert) {
            $this->user = $auth->user() ?: new User;
            $view->share('loggedInUser', $this->user);
            $view->share('alert', $alert);
            return $next($request);
        });
    }

    /**
     * sends back response dependent on type of request
     * @param ?string $redirect
     * @param bool    $refresh
     */
    public function response(?string $redirect = null, bool $refresh = true): string
    {
        if (!$this->request->isXmlHttpRequest()) {
            // if not by AJAX, gotta send them somewhere
            // back from whence they came if no redirect specified
            return Redirect::to(
                is_null($redirect)
                    ? $this->request->server('HTTP_REFERER')
                    : $redirect
            )
                ->withInput();
        }

        // in event of AJAX post, we want to return JSON
        $merge = is_null($redirect)
            ? ['refresh' => $refresh]
            : ['redirect' => $redirect];

        // clear messages only in the case of having errors
        // success messages are accompanied by redirect
        $messages = $this->alert->has('errors')
            ? $this->alert->all()
            : $this->alert->all(false);

        // includes any feedback messages
        // and instructions on whether to reload the page or
        // to redirect to a different page
        return json_encode(
            array_merge(
                $messages ?: [],
                $merge
            )
        );
    }
}
