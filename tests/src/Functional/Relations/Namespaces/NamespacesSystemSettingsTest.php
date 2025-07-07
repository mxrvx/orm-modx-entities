<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Namespaces;

use MXRVX\ORM\MODX\Entities\Namespaces;
use MXRVX\ORM\MODX\Entities\SystemSetting;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class NamespacesSystemSettingsTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:Namespace' => [
            [
                'name' => 'namespace',
                'path' => 'path',
                'assets_path' => 'assets_path',
            ],
            [
                'name' => 'namespace_2',
                'path' => '',
                'assets_path' => '',
            ],
        ],
        'modx:SystemSetting' => [
            [
                'key' => 'key_1',
                'value' => 'value',
                'xtype' => 'xtype',
                'namespace' => 'namespace',
                'area' => 'area',
            ],
            [
                'key' => 'key_2',
                'value' => 'value',
                'xtype' => 'xtype',
                'namespace' => 'namespace',
                'area' => 'area',
            ],
            [
                'key' => 'key_3',
                'value' => 'value',
                'xtype' => 'xtype',
                'namespace' => '',
                'area' => 'area',
            ],
        ],

    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = Namespaces::findByPK('namespace');
        self::assertNotNull($entity);

        $settings = $entity->SystemSettings;

        self::assertIsArray($settings);
        self::assertCount(2, $settings);

        foreach ($settings as $setting) {
            self::assertInstanceOf(SystemSetting::class, $setting);
            self::assertEquals($entity->name, $setting->namespace);
        }
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = Namespaces::findByPK('namespace_2');
        self::assertNotNull($entity);

        $settings = $entity->SystemSettings;

        self::assertIsArray($settings);
        self::assertCount(0, $settings);
    }

    #[Test]
    public function it_creates_entity_with_relation_1(): void
    {
        $entity = Namespaces::make(['name' => 'namespace_100', 'path' => 'path', 'assets_path' => 'assets_path']);

        $entity->SystemSettings = [
            SystemSetting::make(['key' => 'key_100', 'value' => 'value', 'xtype' => 'xtype', 'area' => 'area']),
            SystemSetting::make(['key' => 'key_101', 'value' => 'value', 'xtype' => 'xtype', 'area' => 'area']),
        ];

        self::assertTrue($entity->save());

        $settings = SystemSetting::findAll(['namespace' => 'namespace_100']);

        self::assertCount(2, $settings);
        foreach ($settings as $setting) {
            self::assertInstanceOf(SystemSetting::class, $setting);
            self::assertEquals($entity->name, $setting->namespace);
        }
    }

    #[Test]
    public function it_deletes_entities_by_relation_1(): void
    {
        $namespace = Namespaces::findByPK('namespace');
        $entities = $namespace->SystemSettings;

        self::assertCount(2, $entities);

        foreach ($entities as $entity) {
            self::assertInstanceOf(SystemSetting::class, $entity);
            self::assertTrue($entity->delete());
        }

        $entities = SystemSetting::findAll(['namespace' => 'namespace']);
        self::assertCount(0, $entities);
    }
}
