<?php

namespace Framework;

use ReflectionClass;
use ReflectionException;

class Container
{
    private array $recipes = [];
    private array $services = [];

    public function __construct() {}

    /**
     * @param string $class
     * @param callable $callable
     * @return $this
     */
    public function set(string $class, callable $callable): self
    {
        $this->recipes[$class] = $callable;
        return $this;
    }

    /**
     * @param string $class
     * @return mixed
     * @throws ReflectionException
     */
    public function get(string $class): mixed
    {
        if(isset($this->services[$class])){
            return $this->services[$class];
        }
        if(isset($this->recipes[$class])){
            $service = $this->recipes[$class]($this);
            $this->services[$class] = $service;
            return $service;
        }

        $refl = new ReflectionClass($class);
        $args = [];
        $constructor = $refl->getConstructor();

        if(!$constructor){
            return $refl->newInstance();
        }
        foreach ($refl->getConstructor()->getParameters() as $param) {
            $args[] = $this->get($param->getType()->getName());
        }
        return $refl->newInstance(...$args);
    }
}