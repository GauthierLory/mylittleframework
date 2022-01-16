<?php

namespace Framework;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

class Dispatcher
{
    private Container $container;
    private RouteCollection $routeCollection;

    public function __construct(private Request $request) {}

    public function run()
    {
        $this->configureContainer();
        $this->configureRouter();
        $callable = $this->getControllerCallable();

        /** @var Response $response */
        $response = $callable($this->request);
        $response->send();
    }

    private function configureContainer(): void
    {
        $container = new Container();
        require_once $_ENV['PROJECT_DIR'] . ($_ENV['CONTAINER_CONFIG_FILE'] ?? '/config/container.php');
        $this->container = $container;
    }

    private function configureRouter(): void
    {
        $this->routeCollection = (new YamlFileLoader(new FileLocator))->load($_ENV['PROJECT_DIR']
            . ($_ENV['ROUTER_CONFIG_FILE'] ?? '/config/routes.yaml'));
    }

    private function getControllerCallable(): callable
    {
        $matcher = new UrlMatcher($this->routeCollection, new RequestContext);
        $controller = $matcher->match($this->request->getPathInfo())['_controller'];
        [$className, $methodName] = explode("@", $controller);

        return $this->getCallable($className, $methodName);
    }

    private function getCallable(string $fqcn, string $methodName): callable
    {
        $instance = $this->container->get($fqcn);

        return [$instance, $methodName];
    }
}