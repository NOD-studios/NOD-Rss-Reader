<?php
App::uses('Component', 'Controller');

/**
 * SimplePie factory class.
 *
 *
 * @package       Cake.Controller.Component
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/access-control-lists.html
 */
class SimplePieComponent extends Component {

/**
 * Instance of a SimplePie class
 *
 * @var instance
 */
    protected $instance = null;

    public function ($feed) {
    }

    public function __call($method, $args) {
        //debug(array($this->instance, $method));
        $exists = method_exists($this->instance, $method);
        debug(compact('method', 'args', 'exists'));

        /*
        $feed = new SimplePie();

        // Set which feed to process.

        // Run SimplePie.
        $feed->init();

        // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
        $feed->handle_content_type();
        */
        return call_user_func_array(array($this->instance, $method), $args);
    }

    public function __set($name, $value) {
        $this->instance[$name] = $value;
    }

    public function __get($name) {
        return $this->instance[$name];
    }
}
