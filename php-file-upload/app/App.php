<?php

require_once path(__DIR__ . '/Helpers/Exception.php');
require_once path(__DIR__ . '/Helpers/Session.php');
require_once path(__DIR__ . '/Models/User.php');
require_once path(__DIR__ . '/Router.php');
require_once path(__DIR__ . '/Request.php');
require_once path(__DIR__ . '/BaseController.php');
require_once path(__DIR__ . '/Traits/HasProtectedRoutes.php');
require_once path(__DIR__ . '/Traits/RepresentsDatabaseEntry.php');
require_once path(__DIR__ . '/Controllers/NotFoundController.php');
require_once path(__DIR__ . '/Controllers/HomeController.php');
require_once path(__DIR__ . '/Controllers/LoginController.php');
require_once path(__DIR__ . '/Controllers/RegisterController.php');
require_once path(__DIR__ . '/Controllers/DashboardController.php');
require_once path(__DIR__ . '/Controllers/PostController.php');
require_once path(__DIR__ . '/Models/FormValidation.php');
require_once path(__DIR__ . '/Models/FileValidation.php');
require_once path(__DIR__ . '/Models/Database.php');
require_once path(__DIR__ . '/Helpers/Str.php');
require_once path(__DIR__ . '/Models/Post.php');
require_once path(__DIR__ . '/Models/FileUpload.php');
require_once path(__DIR__ . '/Helpers/Security.php');
require_once path(__DIR__ . '/Controllers/LogoutController.php');
require_once path(__DIR__ . '/Response.php');

class App {
    public function __construct()
    {
         $this->autoloadClasses();

        $router = new Router;
        $this->defineRoutes($router);

        $request = new Request;
        $router->handleRequest($request);

        $requestedController = $router->getRequestedController();
        $requestedMethod = $router->getRequestedMethod();
        $pageParams = $router->getParams();

        $request->setParams($pageParams);

        $controller = new $requestedController;
        $controller->{$requestedMethod}($request);
    }

    private function defineRoutes(Router $router)
    {
        $router->get('/', [HomeController::class, 'index']);

        $router->get('/login', [LoginController::class, 'index']);
        $router->post('/login', [LoginController::class, 'create']);

        $router->get('/register', [RegisterController::class, 'index']);
        $router->post('/register', [RegisterController::class, 'create']);

        $router->get('/logout', [LogoutController::class, 'index']);

        $router->get('/dashboard', [DashboardController::class, 'index']);

        $router->get('/post/create', [PostController::class, 'show']);
        $router->post('/post/create', [PostController::class, 'create']);

        $router->get('/post/:id', [PostController::class, 'index']);

        $router->get('/post/edit/:id', [PostController::class, 'edit']);
        $router->post('/post/edit/:id', [PostController::class, 'update']);

        $router->get('/post/delete/:id', [PostController::class, 'delete']);

        $router->get('/post/like/:id', [PostController::class, 'like']);
        $router->get('/post/dislike/:id', [PostController::class, 'dislike']);

        $router->get('/posts', [PostController::class, 'list']);
    }

    private function autoloadClasses()
    {
        spl_autoload_register(function (string $namespace) {
            $projectNamespace = 'App\\';
            $className = str_replace($projectNamespace, '', $namespace);
            $filePath = path(__DIR__ . '/' . $className . '.php');

            if (file_exists($filePath)) {
                require_once $filePath;
            }
        });
    }
}