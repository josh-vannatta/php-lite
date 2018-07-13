<?php

class Router
{
  public $routes = [
    'GET' => [],
    'POST' => [],
  ];

  public $stubs;

  public static function load($file)
  {
    $router = new static;
    require $file;
    return $router;
  }

  public function define($routes)
  {
    $this->routes = $routes;
  }

  public function get($uri, $controller)
  {
    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri, $controller)
  {
    $this->routes['POST'][$uri] = $controller;
  }

  public function direct($uri, $method)
  {
    if (array_key_exists($uri, $this->routes[$method])) {
      return $this->call(
        ...explode('@', $this->routes[$method][$uri])
      );
    }
    foreach ($this->routes[$method] as $router => $action) {
      $extract = '~^' . preg_replace('/{(.*?)}/', '(.*?)', $router) . '$~';
      if (!preg_match_all($extract, $uri, $matches)) continue;
      $this->extractStubs($matches);
      return $this->call( ...explode('@', $action) );
    }
    Redirect::url('/error/page/does/not/exist');
  }

  protected function extractStubs($uri)
  {
    $stubs = [];
    for ($i = 1; $i < count($uri); $i++)
    		$stubs[] = $uri[$i][0];
    $this->stubs = implode(',', $stubs);
  }

  protected function call($controller, $action)
  {
    $router = new $controller;
    if (! method_exists($router, $action))
    {
      throw new Exception(
        "{$controller} does not include the action: {$action}. Check your routes"
      );
      die();
    }
    return $router->$action(...explode(',', $this->stubs));
  }

}
