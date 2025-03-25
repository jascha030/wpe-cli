<?php

declare(strict_types=1);

namespace Jascha030\WPECLI;

/**
 * @internal
 *
 * @covers \Jascha030\WPECLI\SSHUri
 */
final class SSHUriTest extends \PHPUnit\Framework\TestCase
{
    private const SSH_URI = 'testenv@testenv.ssh.wpengine.net';

    private const SSH_NAME = 'testenv';

    private const SSH_HOST = 'testenv.ssh.wpengine.net';

    public function testUri(): void
    {
        $uri = new SSHUri(self::SSH_URI);

        $this->assertEquals(self::SSH_HOST, $uri->getHost());
        $this->assertEquals(self::SSH_NAME, $uri->getUser());
        $this->assertEquals(self::SSH_URI, $uri->getUrl());
    }

    public function testUriFromEnvironmentName(): void
    {
        $uri = new SSHUri(self::SSH_NAME);

        $this->assertEquals(self::SSH_HOST, $uri->getHost());
        $this->assertEquals(self::SSH_NAME, $uri->getUser());
        $this->assertEquals(self::SSH_URI, $uri->getUrl());
    }
}
