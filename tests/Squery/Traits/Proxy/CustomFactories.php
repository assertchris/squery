<?php

namespace League\Tests\Squery\Traits\Proxy;

use Mockery;

trait CustomFactories
{
    /**
     * @param string $factoryClass
     * @param string $proxyClass
     *
     * @return void
     */
    protected function assertCustomFactories($factoryClass, $proxyClass)
    {
        $factory = Mockery::mock($factoryClass);

        $proxy = forward_static_call([$proxyClass, "with"], $factory);

        $this->assertSame($factory, $this->getProtectedProperty($proxy, "factory"));
    }

    /**
     * @param Mockery\MockInterface $expected
     * @param mixed                 $actual
     * @param string                $message
     *
     * @return void
     */
    abstract protected function assertSame($expected, $actual, $message = "");

    /**
     * @param mixed  $object
     * @param string $property
     *
     * @return mixed
     */
    abstract protected function getProtectedProperty($object, $property);
}
