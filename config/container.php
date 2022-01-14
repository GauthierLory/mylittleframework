<?php
use Framework\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * @var Container $container
 */
$container->set(Environment::class,
    fn() => new Environment(new FileSystemLoader([''], $_ENV['PROJECT_DIR'].$_ENV['TEMPLATES_DIR'])));