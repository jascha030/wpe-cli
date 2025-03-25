<?php
declare(strict_types=1);

namespace Jascha030\WPECLI;

interface SSHUriInterface
{
    public function getHost(): string;

    public function getUser(): string;

    public function getUrl(): string;
}
