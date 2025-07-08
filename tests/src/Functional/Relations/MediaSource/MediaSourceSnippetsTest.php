<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\Category;

use MXRVX\ORM\MODX\Entities\MediaSource;
use MXRVX\ORM\MODX\Entities\Snippet;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class MediaSourceSnippetsTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:MediaSource' => [
            ['id' => 1, 'name' => 'name_1'],
            ['id' => 2, 'name' => 'name_1'],
        ],
        'modx:Snippet' => [
            ['id' => 1, 'name' => 'name_1', 'category' => 1, 'source' => 0],
            ['id' => 2, 'name' => 'name_1', 'category' => 1, 'source' => 1],
            ['id' => 3, 'name' => 'name_2', 'category' => 2, 'source' => 1],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = MediaSource::findByPK(1);
        self::assertNotNull($entity);

        $snippets = $entity->Snippets;

        self::assertIsArray($snippets);
        self::assertCount(2, $snippets);

        foreach ($snippets as $snippet) {
            self::assertInstanceOf(Snippet::class, $snippet);
            self::assertEquals($entity->id, $snippet->source);
        }
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = MediaSource::findByPK(2);
        self::assertNotNull($entity);

        $snippets = $entity->Snippets;

        self::assertIsArray($snippets);
        self::assertCount(0, $snippets);
    }

    #[Test]
    public function it_creates_entity_with_relation_1(): void
    {
        $entity = MediaSource::make(['id' => 100, 'name' => 'name_100']);

        $entity->Snippets = [
            Snippet::make(['name' => 'name_101', 'category' => 1]),
            Snippet::make(['name' => 'name_102', 'category' => 2]),
        ];

        self::assertTrue($entity->save());

        $entity = $this->selectEntity(MediaSource::class, cleanHeap: true)->wherePK(100)->fetchOne();

        $snippets = $entity->Snippets;

        self::assertCount(2, $snippets);
        foreach ($snippets as $snippet) {
            self::assertInstanceOf(Snippet::class, $snippet);
            self::assertEquals($entity->id, $snippet->source);
        }
    }

    #[Test]
    public function it_deletes_entities_by_relation_1(): void
    {
        $entity = MediaSource::findByPK(1);
        self::assertNotNull($entity);
        self::assertTrue($entity->delete());

        $snippets = Snippet::findAll(['source' => $entity->id]);

        self::assertCount(2, $snippets);
        foreach ($snippets as $snippet) {
            self::assertInstanceOf(Snippet::class, $snippet);
            self::assertEquals($entity->id, $snippet->source);
        }
    }
}
