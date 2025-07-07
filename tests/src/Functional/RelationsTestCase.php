<?php


declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional;

use MXRVX\ORM\MODX\Tests\DatabaseTestCase;

abstract class RelationsTestCase extends DatabaseTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (static::$fixtures as $role => $rows) {
            $table = $this->getTableByRole($role);
            if (empty($table)) {
                throw new \Exception(\sprintf('Table for role "%s" not found', $role));
            }

            $table->insertMultiple(\array_keys(\reset($rows)), $rows);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
