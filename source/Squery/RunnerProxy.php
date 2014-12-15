<?php

namespace League\Squery;

use League\Squery;
use League\Squery\Factory\RunnerFactory;
use League\Squery\Runner\Runner;

class RunnerProxy extends AbstractProxy
{
    use Traits\Unacceptable;

    /**
     * @var Factory|RunnerFactory
     */
    protected $factory;

    /**
     * @param Factory|RunnerFactory $factory
     */
    public function __construct(Factory $factory = null)
    {
        if ($factory === null) {
            $factory = new RunnerFactory();
        } else {
            Squery::depreciate("Factories are depreciated (http://squery.thephpleague.com/services)");
        }

        $this->factory = $factory;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    protected function handlesMethod($method)
    {
        return $method === "run";
    }

    /**
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    protected function handleMethod($method, array $parameters)
    {
        $runner = $this->factory->newInstance();

        $this->throwIfUnacceptable($runner, "League\\Squery\\Runner\\Runner");

        return call_user_func_array([$runner, "run"], $parameters);
    }
}
