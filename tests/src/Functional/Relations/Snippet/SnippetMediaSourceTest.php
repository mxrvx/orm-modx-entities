<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Category;

use MXRVX\ORM\MODX\Entities\Snippet;
use MXRVX\ORM\MODX\Entities\MediaSource;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class SnippetMediaSourceTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:MediaSource' => [
            ['id' => 1, 'name' => 'name_1'],
            ['id' => 2, 'name' => 'name_2'],
        ],
        'modx:Snippet' => [
            ['id' => 1, 'name' => 'name_1', 'category' => 1, 'source' => 0],
            ['id' => 2, 'name' => 'name_1', 'category' => 1, 'source' => 1],
            ['id' => 3, 'name' => 'name_2', 'category' => 2, 'source' => 2],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = Snippet::findByPK(1);
        self::assertNotNull($entity);

        $source = $entity->Source;

        self::assertNull($source);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = Snippet::findByPK(2);
        self::assertNotNull($entity);

        $source = $entity->Source;

        self::assertNotNull($source);
        self::assertInstanceOf(MediaSource::class, $source);
        self::assertEquals($entity->source, $source->id);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = Snippet::findByPK(3);
        self::assertNotNull($entity);

        $source = $entity->Source;

        self::assertNotNull($source);
        self::assertInstanceOf(MediaSource::class, $source);
        self::assertEquals($entity->source, $source->id);
    }

    public function it_creates_entity_with_relation_1(): void
    {
        $entity = Snippet::make(['id' => 100, 'name' => 'name_100', 'category' => 1]);

        $entity->Source = MediaSource::make(['id' => 11, 'name' => 'name_11']);

        self::assertTrue($entity->save());

        $source = MediaSource::findOne(['id' => 11]);

        self::assertInstanceOf(MediaSource::class, $source);
        self::assertEquals($entity->source, $source->id);
    }

    #[Test]
    public function it_deletes_entities_by_relation_1(): void
    {
        $entity = Snippet::findByPK(3);
        $source = $entity->Source;

        self::assertInstanceOf(MediaSource::class, $source);
        self::assertEquals($entity->source, $source->id);

        self::assertTrue($entity->delete());

        $source = MediaSource::findOne(['id' => $source->id]);

        self::assertInstanceOf(MediaSource::class, $source);
        self::assertEquals($entity->source, $source->id);
    }
}
