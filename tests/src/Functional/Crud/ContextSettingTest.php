<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\ContextSetting;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<ContextSetting>
 */
final class ContextSettingTest extends CrudTestCase
{
    /** @var class-string<ContextSetting> */
    protected static string $class = ContextSetting::class;

    /** @var string|string[] */
    protected static string|array $pk = ['context_key','key'];

    protected static array $data = [
        'context_key' => 'context_key',
        'key' => 'key',
        'value' => 'value',
        'xtype' => 'xtype',
        'namespace' => 'namespace',
        'area' => 'area',
    ];
}
