<?php

declare(strict_types=1);

namespace Jascha030\WPECLI;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use function realpath;

/**
 * @internal
 *
 * @covers \Jascha030\WPECLI\Git
 */
#[CoversClass(Git::class)]
final class GitTest extends TestCase
{
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::cleanTestDir();
    }

    private static function cleanTestDir(): void
    {
        deleteWhenExists(TEST_OUTPUT_DIR . '/php-option');
    }

    public function testGetGit(): void
    {
        $git = new Git();

        self::assertIsString($git->getGit());
        self::assertFileExists($git->getGit());
    }

    public function testGetRepositoryNameFromUrl(): void
    {
        $expected = 'php-option';
        $github = 'git@github.com:schmittjoh/php-option.git';
        $withClone = 'git clone git@github.com:schmittjoh/php-option.git';

        self::assertEquals($expected, (new Git())->getRepositoryNameFromUrl($github));
        self::assertEquals($expected, (new Git())->getRepositoryNameFromUrl($withClone));
    }

    public function testClone(): void
    {
        self::cleanTestDir();

        chdir(TEST_OUTPUT_DIR);

        $dir = (new Git())->clone('git@github.com:schmittjoh/php-option.git');

        self::assertDirectoryExists($dir->getRealPath());
        self::assertEquals($dir->getRealPath(), realpath(TEST_OUTPUT_DIR . '/php-option'));
    }

    public function testCloneWithPredefinedDir(): void
    {
        self::cleanTestDir();

        $dir = (new Git())->clone('git@github.com:schmittjoh/php-option.git', TEST_OUTPUT_DIR . '/php-option');

        self::assertDirectoryExists($dir->getRealPath());
        self::assertEquals($dir->getRealPath(), realpath(TEST_OUTPUT_DIR . '/php-option'));
    }
}
