<?php

namespace Tests\AppBundle\Traits;

trait CallMethodTrait
{
    /**
     * This method allows you to call protected methods
     *
     * @param $obj
     * @param $name
     * @param array $args
     *
     * @return mixed
     */
    public function callMethod($obj, $name, array $args)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }
}
