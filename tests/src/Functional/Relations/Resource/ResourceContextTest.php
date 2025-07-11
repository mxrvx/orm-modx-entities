<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Category;

use MXRVX\ORM\MODX\Entities\Context;
use MXRVX\ORM\MODX\Entities\Resource;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ResourceContextTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:Context' => [
            ['key' => 'context_key', 'name' => 'name_1'],
            ['key' => 'context_key_2', 'name' => 'name_2'],
        ],
        'modx:Resource' => [
            ['id' => 1, 'pagetitle' => 'pagetitle_1', 'parent' => 0, 'context_key' => 'context_key','description' => ''],
            ['id' => 2, 'pagetitle' => 'pagetitle_2', 'parent' => 1, 'context_key' => 'context_key','description' => ''],
            ['id' => 3, 'pagetitle' => 'pagetitle_3', 'parent' => 1, 'context_key' => 'context_key_2','description' => ''],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = Resource::findByPK(1);
        self::assertNotNull($entity);

        $context = $entity->Context;

        self::assertNotNull($context);
        self::assertInstanceOf(Context::class, $context);
        self::assertEquals($entity->context_key, $context->key);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = Resource::findByPK(2);
        self::assertNotNull($entity);

        $context = $entity->Context;

        self::assertNotNull($context);
        self::assertInstanceOf(Context::class, $context);
        self::assertEquals($entity->context_key, $context->key);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = Resource::findByPK(3);
        self::assertNotNull($entity);

        $context = $entity->Context;

        self::assertNotNull($context);
        self::assertInstanceOf(Context::class, $context);
        self::assertEquals($entity->context_key, $context->key);
    }
}
