<?php
namespace App\Http\Controllers;

/**
 * PageController class
 */

use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\View\Factory as View;
use App\Alerts\Alert;
use Redirect;

/**
 * Top-level controller for displaying pages
 */
class PageController extends BaseController
{
    /** layout view */
    protected $user;
    protected $request;
    protected $alert;

    /**
     * default constructor
     * @param Request   $request
     */
    public function __construct(AuthManager $auth, Request $request, View $view, Alert $alert)
    {
        $this->alert = $alert;
        $this->request = $request;
        $this->middleware(function ($request, $next) use ($auth, $view, $alert) {
            $this->user = $auth->user();
            $view->share('loggedInUser', $this->user);
            $view->share('alert', $alert);
            return $next($request);
        });
    }

    /**
     * sends back response dependent on type of request
     *
     * @param string    $redirect
     * @param bool      $refresh
     * @return string
     */
    public function response($redirect = null, $refresh = true)
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
            ? array('refresh' => $refresh)
            : array('redirect' => $redirect);

        // clear messages only in the case of having errors
        // success messages are accompanied by redirect
        $messages = $this->alert->has('errors')
            ? $this->alert->all()
            : $this->alert->all(false);

        // includes any feedback messages
        // and instructions on whether to reload the page or
        // to redirect to a different page
        return response(json_encode(
            array_merge(
                $messages ?: array(),
                $merge
            )
        ));
    }
}
