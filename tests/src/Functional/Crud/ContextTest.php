<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Context;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Context>
 */
final class ContextTest extends CrudTestCase
{
    /** @var class-string<Context> */
    protected static string $class = Context::class;

    /** @var string|string[] */
    protected static string|array $pk = 'key';

    protected static array $data = [
        'key' => 'key',
        'name' => 'name',
    ];
}
