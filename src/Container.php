<?php
namespace App;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    private $services = [];

    public function add($name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get($name)
    {
        if (!$this->has($name)) {
            throw new Exception("Service '$name' not found in the container.");
        }

        
        if ($this->services[$name] instanceof Closure) {
            return $this->services[$name]();
        }

        return $this->services[$name];
    }

    public function has($name)
    {
        return array_key_exists($name, $this->services);
    }
}
