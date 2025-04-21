<?php

declare(strict_types=1);

namespace Jascha030\WPECLI;

use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

trait CommandFactoryTrait
{
    /**
     * @return array<string,string>
     */
    private function getCreateCommandArguments(): array
    {
        return [];
    }

    private function createCommandTester(Command $instance): CommandTester
    {
        $name = $instance->getName();

        if (null === $name) {
            throw new RuntimeException('Command name is not set.');
        }

        $app = new Application();
        $app->setAutoExit(false);
        $app->add($instance);

        $command = $app->find($name);

        return new CommandTester($command);
    }
}
