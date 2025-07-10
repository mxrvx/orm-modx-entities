<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Snippet;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Snippet>
 */
final class SnippetTest extends CrudTestCase
{
    /** @var class-string<Snippet> */
    protected static string $class = Snippet::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 1,
        'name' => 'name',
        'source' => 1,
        'static' => true,
        'static_file' => 'core/components/component/elements/file.php',
        'category' => 1,
        'snippet' => '@code snippet',
        'properties' => [['key' => 'value']],
    ];
}
