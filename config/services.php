<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

return $container;

