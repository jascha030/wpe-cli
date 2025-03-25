<?php

declare(strict_types=1);

namespace Jascha030\WPECLI;

class SSHUri implements SSHUriInterface
{
    private string $user;

    private string $host;

    public function __construct(string $url)
    {
        $match = 0 !== preg_match(
            '/([a-zA-Z]+)\@([a-zA-Z]+)\.ssh\.wpengine.net/',
            $url,
            $matches
        );

        $this->user = $match ? $matches[1] : $url; // @phpstan-ignore-line
        $this->host = ($match ? $matches[1] : $url) . '.ssh.wpengine.net'; // @phpstan-ignore-line
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getUrl(): string
    {
        return $this->getUser() . '@' . $this->getHost();
    }
}
