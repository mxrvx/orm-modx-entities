<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Namespaces;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Namespaces>
 */
final class NamespacesTest extends CrudTestCase
{
    /** @var class-string<Namespaces> */
    protected static string $class = Namespaces::class;

    /** @var string|string[] */
    protected static string|array $pk = 'name';

    protected static array $data = [
        'name' => 'name',
        'path' => 'path',
        'assets_path' => 'assets_path',
    ];
}
