<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Category;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Category>
 */
final class CategoryTest extends CrudTestCase
{
    /** @var class-string<Category> */
    protected static string $class = Category::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 10,
        'parent' => 0,
        'category' => 'category',
        'rank' => 1,
    ];
}
