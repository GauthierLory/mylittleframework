-which design is use?
-front controller

## Installation
This framework is available as git clone

```
    $ git clone https://github.com/gauthierLory/Framework
```
then launch 
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
Where 'App\Controller\HelloController' is your Controller FQCN and '__invoke' the method to call.
Your Controller method must :
 - take a Symfony\Component\HttpFoundation\Response as only parameter
 - return an instance of Symfony\Component\HttpFoundation\Response


- model
- template
- how to make a controller