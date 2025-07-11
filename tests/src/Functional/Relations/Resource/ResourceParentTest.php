<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Category;

use MXRVX\ORM\MODX\Entities\Resource;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ResourceParentTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:Resource' => [
            ['id' => 1, 'pagetitle' => 'pagetitle_1', 'parent' => 0, 'context_key' => 'context_key','description' => ''],
            ['id' => 2, 'pagetitle' => 'pagetitle_2', 'parent' => 1, 'context_key' => 'context_key','description' => ''],
            ['id' => 3, 'pagetitle' => 'pagetitle_3', 'parent' => 1, 'context_key' => 'context_key','description' => ''],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = Resource::findByPK(1);
        self::assertNotNull($entity);

        $parent = $entity->Parent;

        self::assertNull($parent);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = Resource::findByPK(2);
        self::assertNotNull($entity);

        $parent = $entity->Parent;

        self::assertNotNull($parent);
        self::assertInstanceOf(Resource::class, $parent);
        self::assertEquals($entity->parent, $parent->id);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = Resource::findByPK(3);
        self::assertNotNull($entity);

        $parent = $entity->Parent;

        self::assertNotNull($parent);
        self::assertInstanceOf(Resource::class, $parent);
        self::assertEquals($entity->parent, $parent->id);
    }
}
