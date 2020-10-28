 <?php
 require __DIR__ . '/vendor/autoload.php';



 use App\Controllers\ErrorController;
 use Symfony\Component\Config\FileLocator;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Exception\MethodNotAllowedException;
 use Symfony\Component\Routing\Exception\ResourceNotFoundException;
 use Symfony\Component\Routing\Loader\YamlFileLoader;
 use Symfony\Component\Routing\Matcher\UrlMatcher;
 use Symfony\Component\Routing\RequestContext;


 $fileLocator = new FileLocator(array(__DIR__ . '/config'));
 $loader = new YamlFileLoader($fileLocator);
 $routes = $loader->load('routes.yaml');

 $request = Request::createFromGlobals();
 $context = new RequestContext();
 $context->fromRequest($request);
 $matcher = new UrlMatcher($routes, $context);

 try {
     $attributes = $matcher->match($request->getPathInfo());
     $object = explode('::', $attributes['_controller']);
     $class = $object[0];

     call_user_func_array([new $class(), $object[1]], [$request, $attributes]);
 } catch (ResourceNotFoundException $exception) {
     $response = call_user_func(new ErrorController());
     $response->send();
 } catch (MethodNotAllowedException $exception) {
     echo $exception->getMessage();
 }
