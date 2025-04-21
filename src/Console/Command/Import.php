<?php

declare(strict_types=1);

namespace Jascha030\WPECLI\Console\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'import')]
final class Import extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // Ask ssh env name or so
        //
        // resolve paths to public root
        //
        // find wp-content/mysql.sql


        return Command::SUCCESS;
    }
}
