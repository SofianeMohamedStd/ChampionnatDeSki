<?php

use App\Controllers\HomeController;
use App\Repository\CategorieRepository;
use JsonSchema\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\YamlFileLoader;

require __DIR__.'/vendor/autoload.php';


$params = explode('/', $_GET['url']);


try
{
    // Load routes from the yaml file
    $fileLocator = new FileLocator(array(__DIR__.'/config'));
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes.yaml');
    // Init RequestContext object
    $request =  Request::createFromGlobals();
    $context = new RequestContext();

    $context->fromRequest($request);

    // Init UrlMatcher object
    $matcher = new UrlMatcher($routes, $context);

    // Find the current route
    $parameters = $matcher->match($context->getPathInfo());
    
    $params = explode('::', $parameters['_controller']);
    $response = new Response();

    if ($params[0] !== null) {

    $controller = $params[0];
    $action = $params[1];
    $controller = new $controller();


        if (method_exists($controller, $action)) {
           call_user_func_array([$controller,$action], [$request, $response]);

        } else {
            // Send 404 response
            http_response_code(404);
            $error = "The requested page does not exist";
            $controller = new HomeController();
            $controller->errorPage($error);
        }

    } else {
        // 
        // Instance contrôleur
        $controller = new HomeController();
        // Call method HomePage
        $controller->homePage($request, $response);
    }
}
catch (Exception $error) { 
    $controller = new HomeController();
    $controller->errorPage($error);
}