<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\SystemSetting;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<SystemSetting>
 */
final class SystemSettingTest extends CrudTestCase
{
    /** @var class-string<SystemSetting> */
    protected static string $class = SystemSetting::class;

    /** @var string|string[] */
    protected static string|array $pk = 'key';

    protected static array $data = [
        'key' => 'key',
        'value' => 'value',
        'xtype' => 'xtype',
        'namespace' => 'namespace',
        'area' => 'area',
    ];
}
