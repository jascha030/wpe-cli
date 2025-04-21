<?php

declare(strict_types=1);

namespace Jascha030\WPECLI;

use RuntimeException;
use SplFileInfo;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

use function sprintf;

class Git
{
    private string $git;

    /**
     * Find and local git binary for shell execution of git commands.
     *
     * @throws RuntimeException when no executable binary is found on the system
     *
     * @see ExecutableFinder
     */
    public function getGit(): string
    {
        return ($this->git ??= (new ExecutableFinder())->find('git'))
            ?? throw new RuntimeException('Could not find binary for "git", make sure it is installed on your system.');
    }

    public function clone(string $repository, ?string $directory = null): SplFileInfo
    {
        if (null === $directory) {
            $directory = getcwd() . '/' . $this->getRepositoryNameFromUrl($repository);
        }

        $process = Process::fromShellCommandline(sprintf('git clone %s %s', escapeshellarg($repository), escapeshellarg($directory)));

        try {
            $process->mustRun();
        } catch (ProcessFailedException) {
            throw new RuntimeException(sprintf('Git clone failed: %s', $process->getErrorOutput()));
        }

        return new SplFileInfo($directory);
    }

    public function getRepositoryNameFromUrl(string $repository): string
    {
        $parts = explode('/', $this->cleanGitUrl($repository));

        return preg_replace('/\.git$/', '', end($parts));
    }

    private function cleanGitUrl(string $repository): string
    {
        return preg_replace('/git clone /', '', $repository);
    }
}
