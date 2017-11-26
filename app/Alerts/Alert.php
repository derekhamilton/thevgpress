<?php
namespace App\Alerts;

/**
 * Alert class
 */

 use Illuminate\Session\SessionManager;

 /**
 * Alert handling and response
 */
class Alert
{

    /** @var Session */
    protected $session;

    /**
     * @param Session   $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * Add a message to the session
     *
     * $type is is passed in the form of [basetype.target] where
     * target indicates the target
     * HTML element ID to place the messages when needed.
     * For example, errors.errors-comments would look for an
     * element #errors-comments
     * while still being grouped under errors for message purposes
     *
     * @param string $type    the type of message (error/success/info)
     * @param string $message the message
     * @return void
     */
    public function add($type, $message)
    {
        $messages = $this->session->get('reportBag') ?: new ReportBag();
        $messages->add($type, $message);
        $this->session->put('reportBag', $messages);
    }

    /**
     * @param string $message
     * @return void
     */
    public function success($message)
    {
        $this->add('successes', $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function error($message)
    {
        $this->add('errors', $message);
    }

    /**
     * Retrieve messages from the session
     * @param string $type  the type of messages to retrieve
     * @param bool   $clear whether to delete messages after retrieving
     * @return mixed array or json string
     */
    public function get($type, $clear = true)
    {
        $messages = $this->session->get('reportBag');

        if (is_null($messages)) {
            return null;
        }

        $messagesArray = $messages->get($type);
        if ($clear) {
            $messages->delete($type);
            $this->session->put('reportBag', $messages);
        }

        return $messagesArray;
    }

    /**
     * true/false if there are message of the given type
     * @param string    $type
     * @return bool
     */
    public function has($type)
    {
        return $this->session->has('reportBag')
            ? $this->session->get('reportBag')->has($type)
            : false;
    }

    /**
     * Retrieve all messages
     *
     * Messages are returned in the form of
     * array ( [type] => array ( [target] => array ( [messages] ) ) )
     * where target is used for the target element ID to place the messages.
     *
     * @param bool      $clear  whether to delete messages after retrieving
     * @return mixed    array or json string
     */
    public function all($clear = true)
    {
        $messages = $this->session->get('reportBag');
        if ($clear) {
            $this->session->forget('reportBag');
        }

        if (!($messages instanceof ReportBag)) {
            return null;
        }

        $return = array();
        foreach ($messages->toArray() as $key => $message) {
            if (strpos($key, '.') !== false) {
                list($type, $target) = explode('.', $key);
                $return['messages'][$type][$target] = $message;
            } else {
                // if no target is specified,
                // use the key to maintain consistent structure
                $return['messages'][$key][$key] = $message;
            }
        }

        return $return;
    }
}
