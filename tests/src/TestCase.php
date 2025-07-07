<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests;

use DI\Container;
use MXRVX\ORM\Tools\Files;

/** @psalm-suppress UndefinedClass */
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected ?\modX $modx = null;

    public function getContainer(): Container
    {
        if ($this->modx === null) {
            throw new \RuntimeException('MODX instance is not initialized');
        }

        return \MXRVX\Autoloader\App::getInstance($this->modx)->getContainer();
    }

    protected function setUp(): void
    {
        parent::setUp();

        /** @psalm-suppress MissingFile */
        if (!\class_exists(\modX::class) && \file_exists(MODX_CORE_PATH . 'model/modx/modx.class.php')) {
            require MODX_CORE_PATH . 'model/modx/modx.class.php';
        }

        Files::deleteDirectory(MODX_CORE_PATH . 'cache/', true);

        $modx = new \modX('', ['cache_path' => \getenv('CACHE_PATH')]);
        $modx->startTime = \microtime(true);
        $modx->initialize();

        $modx->switchContext('web');
        $this->modx = $modx;

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->modx->getCacheManager()->refresh();

        $this->modx = null;
    }
}
