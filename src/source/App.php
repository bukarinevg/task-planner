<?php
namespace app\source;


use app\source\http\RequestHandler;
use app\source\http\UrlRouting;

/**
 * This is the main application class.
 */
class App
{
    /**
     * @var array $config The application configuration.
     */
    private $config;


    /**
     * @var mixed $request The request object.
     */
    private $request;

    /**
     * App constructor.
     *
     * @param array $config The configuration options for the App.
     */
    function __construct($config )
    {
        $this->config = $config;
        
    }

    /**
     * Runs the application.
     */
    public function run()
    {
        $this->setRequest(new RequestHandler());
        $this->callController((new UrlRouting())->getController() );        
    }

    /**
     * Calls the controller and method from the URL.
     *
     * @param array $route An array containing the controller and method.
     */
    public function callController($route)
    {
        try {
            $controller =  $route['controller'];
            $method = $route['method'];

            if (!class_exists($controller)) {
                throw new \Exception("Controller $controller does not exist");
            }
            $controllerInstance = new $controller($this);
    
            if (!method_exists($controllerInstance, $method)) {
                throw new \Exception("Method $method does not exist in controller $controller");
            }
    
            $controllerInstance->$method();
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @return  self
     */ 
    public function setRequest(RequestHandler $requestHandler)
    {
        $this->request = $requestHandler;
        return $this;
    }
}
