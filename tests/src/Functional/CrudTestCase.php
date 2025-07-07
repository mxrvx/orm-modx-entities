<?php


declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional;

use MXRVX\ORM\AR\AR;
use MXRVX\ORM\MODX\Tests\DatabaseTestCase;
use PHPUnit\Framework\Attributes\Test;

/**
 * @template T of AR
 */
abstract class CrudTestCase extends DatabaseTestCase
{
    /** @var class-string<T> */
    protected static string $class;

    /** @var string|string[] */
    protected static string|array $pk;

    protected static array $data;

    public function get_pk(null|array|object $data = null): null|string|array
    {
        $keys = \is_array(static::$pk) ? static::$pk : [static::$pk];
        $data = $data ?? static::$data;

        if (\is_object($data)) {
            $data = $data->toArray();
        }

        $array = [];
        foreach ($keys as $key) {
            if (\array_key_exists($key, $data)) {
                $array[$key] = $data[$key];
            } else {
                $array[$key] = null;
            }
        }

        return \count($keys) === \count($array) ? $array : null;
    }

    public function get_data(null|array|object $data = null): null|string|array
    {
        $data = $data ?? static::$data;

        if (\is_object($data)) {
            $data = $data->toArray();
        }

        return \array_intersect_key($data, \array_flip(static::$data));
    }

    #[Test]
    public function it_creates_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make([]);

        $this->assertInstanceOf(static::$class, $entity);
        self::assertNotSame(static::$class, $entity::class, 'An Entity Proxy is created');
    }

    #[Test]
    public function it_saves_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);

        self::assertTrue($entity->save());
        self::assertCount(1, $class::findAll());

        $result = $this->selectEntity(static::$class, cleanHeap: true)->wherePK(static::get_pk())->fetchOne();

        self::assertSame(static::get_pk($result), static::get_pk($entity));
    }

    #[Test]
    public function it_saves_entity_and_fail(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make([]);

        self::assertFalse($entity->save());
        self::assertCount(0, $class::findAll());
    }

    #[Test]
    public function it_reading_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);

        self::assertTrue($entity->save());

        $result = $this->selectEntity(static::$class, cleanHeap: true)->wherePK(static::get_pk())->fetchOne();

        self::assertSame(static::get_data($result), static::get_data($entity));
    }

    #[Test]
    public function it_deletes_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);

        self::assertTrue($entity->save());
        self::assertNotNull($entity);

        self::assertTrue($entity->delete());
        self::assertCount(0, $class::findAll());
    }

    #[Test]
    public function it_finds_one_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);
        self::assertTrue($entity->save());

        $entity = $class::findOne(static::get_pk());
        self::assertNotNull($entity);
        self::assertSame(static::get_data(), static::get_data($entity));
    }

    #[Test]
    public function it_finds_all_entities(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);
        self::assertTrue($entity->save());

        $entities = $class::findAll();
        self::assertCount(1, $entities);
    }

    #[Test]
    public function it_finds_entity_by_primary_key(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);
        self::assertTrue($entity->save());

        $entity = $class::findByPK(static::get_pk());
        self::assertNotNull($entity);
        self::assertSame(static::get_data(), static::get_data($entity));
    }

    #[Test]
    public function it_query_to_select_entity(): void
    {
        /** @var class-string<AR> $class */
        $class = static::$class;
        $entity = $class::make(static::$data);
        self::assertTrue($entity->save());
        $entity = $class::query()->where(static::get_pk())->fetchOne();

        self::assertNotNull($entity);
        self::assertSame(static::get_data(), static::get_data($entity));
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
