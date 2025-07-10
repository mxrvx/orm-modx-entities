<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\MediaSource;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<MediaSource>
 */
final class MediaSourceTest extends CrudTestCase
{
    /** @var class-string<MediaSource> */
    protected static string $class = MediaSource::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 1,
        'name' => 'name',
        'properties' => [['key' => 'value']],
    ];
}
