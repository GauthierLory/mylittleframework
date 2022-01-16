## Which design is use?
We use a front controller which is a single PHP file through which all requests are processed.
- An entry point on the index.php file which will receive all the requests. It is him who will instantiate the application in which is included the app.php file which is the bootstrap of the application.
- A Service Container, which is contained in the Dispatcher, will manage the client's request and provide the answer.
- The Dispatcher's run() method will invoke the router and depending on the route, instantiate the right method in the right controller to answer the request.
- Then the Twig component will take care of managing the views in the response to the client that will be prepared in the Service Container.

## Installation
```
    $ git clone https://github.com/gauthierLory/mylittleframework
```
then launch to install depedencies
```bash
composer install
```
### Configure .env
Clone the .env.example and fill the path of files
```dotenv
CONTAINER_CONFIG_FILE=/config/container.php
ROUTER_CONFIG_FILE=/config/routes.yaml
TEMPLATES_DIR=/templates
```
### command to launch local server
```
php -S localhost:8000 -t public/
```

## Routing configuration
```yaml
hello:
  path: /hello
  controller: App\Controller\HelloController@__invoke
```
Where ``` App\Controller\HelloController``` is your Controller FQCN and ```__invoke``` the method to call.
Your Controller method must :
 - take a ```Symfony\Component\HttpFoundation\Response``` as only parameter
 - return an instance of ```Symfony\Component\HttpFoundation\Response```
 
## How to make a controller
```php
<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Twig\Environment;
  use Twig\Error\LoaderError;
  use Twig\Error\RuntimeError;
  use Twig\Error\SyntaxError;

  class TestController 
  {

      function __construct(private Environment $environment) {}
    
      /**
      * @throws SyntaxError
      * @throws RuntimeError
      * @throws LoaderError
      */
    function __invoke(Request $request): Response {
      return new Response(
      $this->environment->render('test.html.twig', ['message' => 'test controller'])
      );
    }
}
```
## Template
The ```test.html.twig``` file in folder templates :
```html
<html lang="fr">
<head>
    <title>Test controller</title>
</head>
<body>
    <h3>Test message controller : {{ message }}</h3>
</body>
</html>
```