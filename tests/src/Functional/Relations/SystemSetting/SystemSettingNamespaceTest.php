<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\SystemSetting;

use MXRVX\ORM\MODX\Entities\Namespaces;
use MXRVX\ORM\MODX\Entities\SystemSetting;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class SystemSettingNamespaceTest extends RelationsTestCase
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
                'path' => 'path',
                'assets_path' => 'assets_path',
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
                'namespace' => 'namespace_2',
                'area' => 'area',
            ],
        ],

    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = SystemSetting::findByPK('key_1');
        self::assertNotNull($entity);

        $namespace = $entity->Namespace;

        self::assertNotNull($namespace);
        self::assertInstanceOf(Namespaces::class, $namespace);
        self::assertEquals($entity->namespace, $namespace->name);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = SystemSetting::findByPK('key_2');
        self::assertNotNull($entity);

        $namespace = $entity->Namespace;

        self::assertNotNull($namespace);
        self::assertInstanceOf(Namespaces::class, $namespace);
        self::assertEquals($entity->namespace, $namespace->name);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = SystemSetting::findByPK('key_3');
        self::assertNotNull($entity);

        $namespace = $entity->Namespace;

        self::assertNotNull($namespace);
        self::assertInstanceOf(Namespaces::class, $namespace);
        self::assertEquals($entity->namespace, $namespace->name);
    }

    #[Test]
    public function it_creates_entity_with_relation_1(): void
    {
        $entity = SystemSetting::make([
            'key' => 'key_100',
            'value' => 'value',
            'xtype' => 'xtype',
            'area' => 'area',
        ], );
        $entity->Namespace = Namespaces::make(['name' => 'namespace_100', 'path' => 'path', 'assets_path' => 'assets_path']);

        self::assertTrue($entity->save());

        $namespace = Namespaces::findByPK('namespace_100');

        self::assertInstanceOf(Namespaces::class, $namespace);
        self::assertEquals($entity->namespace, $namespace->name);
    }

    #[Test]
    public function it_deletes_entities_by_relation_1(): void
    {
        $namespace = Namespaces::findByPK('namespace');
        $entities = $namespace->SystemSettings;

        self::assertCount(2, $entities);

        Namespaces::transact(static function () use ($namespace, $entities): void {
            self::assertTrue($namespace->delete());
            foreach ($entities as $entity) {
                self::assertTrue($entity->delete());
            }
        });

        $entities = SystemSetting::findAll(['namespace' => 'namespace']);
        self::assertCount(0, $entities);
    }

    #[Test]
    public function it_deletes_entities_by_relation_2(): void
    {
        $namespace = Namespaces::findByPK('namespace_2');
        $entities = $namespace->SystemSettings;

        self::assertCount(1, $entities);

        Namespaces::transact(static function () use ($namespace, $entities): void {
            self::assertTrue($namespace->delete());
            foreach ($entities as $entity) {
                self::assertTrue($entity->delete());
            }
        });

        $entities = SystemSetting::findAll(['namespace' => 'namespace_2']);
        self::assertCount(0, $entities);
    }
}
