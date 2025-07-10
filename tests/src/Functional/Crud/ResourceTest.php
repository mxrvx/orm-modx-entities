<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Resource;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Resource>
 */
final class ResourceTest extends CrudTestCase
{
    /** @var class-string<Resource> */
    protected static string $class = Resource::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 1,
        'pagetitle' => 'pagetitle',
    ];
}
