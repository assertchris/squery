<?php

namespace League\Squery\Factory;

use League\Squery\Factory;
use League\Squery\Process\SymfonyProcess;
use Symfony\Component\Process\Process;

class ProcessFactory implements Factory
{
    /**
     * @return Process
     */
    public function newInstance()
    {
        return new SymfonyProcess(
            new Process("echo")
        );
    }
}
