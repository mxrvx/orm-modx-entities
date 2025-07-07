<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Category;

use MXRVX\ORM\MODX\Entities\Category;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CategoryChildrensTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:Category' => [
            ['id' => 1, 'parent' => 0, 'category' => 'category_1', 'rank' => 0],
            ['id' => 2, 'parent' => 1, 'category' => 'category_2', 'rank' => 1],
            ['id' => 3, 'parent' => 0, 'category' => 'category_3', 'rank' => 2],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = Category::findByPK(1);
        self::assertNotNull($entity);

        $childrens = $entity->Childrens;

        self::assertIsArray($childrens);
        self::assertCount(1, $childrens);

        foreach ($childrens as $children) {
            self::assertInstanceOf(Category::class, $children);
            self::assertEquals(1, $children->parent);
            self::assertEquals(2, $children->id);
        }
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = Category::findByPK(2);
        self::assertNotNull($entity);

        $childrens = $entity->Childrens;
        self::assertIsArray($childrens);
        self::assertCount(0, $childrens);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = Category::findByPK(3);
        self::assertNotNull($entity);

        $childrens = $entity->Childrens;
        self::assertIsArray($childrens);
        self::assertCount(0, $childrens);
    }
}
