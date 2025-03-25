<?php
declare(strict_types=1);

namespace Jascha030\WPECLI\Console\Command;

use Jascha030\WPECLI\SSHUri;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'db:dump')]
class Dump extends Command
{
    public function configure(): void
    {
        $this
            ->setDescription('Import the last database dump')
            ->addArgument('environment', InputArgument::REQUIRED, 'The environment to import the database dump from.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $url    = $input->getArgument('environment');
        $ssh    = new SSHUri($url);
        $path   = getcwd();
        $sshUrl = $ssh->getUrl();
        $user   = $ssh->getUser();

        system("scp -O {$sshUrl}:sites/{$user}/wp-content/mysql.sql wp_{$user}.sql", $code);

        return $code;
    }
}
