<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\User;

use MXRVX\ORM\MODX\Entities\User;
use MXRVX\ORM\MODX\Entities\UserProfile;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class UserProfileTest extends RelationsTestCase
{
    /** @var array<string,array<string, mixed>> $fixtures */
    protected static array $fixtures = [
        'modx:User' => [
            ['id' => 1, 'username' => 'username', 'primary_group' => 0],
            ['id' => 2, 'username' => 'username_2', 'primary_group' => 0],
            ['id' => 3, 'username' => 'username_3', 'primary_group' => 0],
        ],
        'modx:UserProfile' => [
            ['id' => 10, 'internalKey' => 1, 'fullname' => 'fullname', 'email' => 'email@mail.ru', 'address' => '', 'comment' => ''],
            ['id' => 20, 'internalKey' => 2, 'fullname' => 'fullname', 'email' => 'email@mail.ru', 'address' => '', 'comment' => ''],
        ],
    ];

    #[Test]
    public function it_get_relation_entity_1(): void
    {
        $entity = User::findByPK(1);
        self::assertNotNull($entity);

        $profile = $entity->Profile;

        self::assertNotNull($profile);
        self::assertInstanceOf(UserProfile::class, $profile);
        self::assertEquals($entity->id, $profile->internalKey);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = User::findByPK(2);
        self::assertNotNull($entity);

        $profile = $entity->Profile;

        self::assertNotNull($profile);
        self::assertInstanceOf(UserProfile::class, $profile);
        self::assertEquals($entity->id, $profile->internalKey);
    }

    #[Test]
    public function it_get_relation_entity_3(): void
    {
        $entity = User::findByPK(3);
        self::assertNotNull($entity);

        $profile = $entity->Profile;

        self::assertNull($profile);
    }

    #[Test]
    public function it_creates_entity_with_relation_1(): void
    {
        $entity = User::make(['username' => 'username_100', 'primary_group' => 0]);
        $entity->Profile = UserProfile::make(['fullname' => 'username_100', 'email' => 'email100@mail.ru', 'address' => '', 'comment' => '']);

        self::assertTrue($entity->save());

        $profile = UserProfile::findOne(['internalKey' => $entity->id]);

        self::assertInstanceOf(UserProfile::class, $profile);
        self::assertEquals($entity->id, $profile->internalKey);
    }

    #[Test]
    public function it_deletes_entities_with_relation_1(): void
    {
        $entity = User::findByPK(1);
        $profile = $entity->Profile;

        self::assertNotNull($profile);
        self::assertInstanceOf(UserProfile::class, $profile);

        User::transact(static function () use ($entity, $profile): void {
            self::assertTrue($entity->delete());
            self::assertTrue($profile->delete());
        });

        $profile = UserProfile::findOne(['internalKey' => 1]);
        self::assertNull($profile);
    }

    #[Test]
    public function it_deletes_relation_without_entity_1(): void
    {
        $relation = UserProfile::findOne(['internalKey' => 1]);
        $user = $relation->User;

        self::assertNotNull($user);
        self::assertInstanceOf(User::class, $user);
        self::assertTrue($relation->delete());

        $user = User::findByPK(1);
        self::assertNotNull($user);
    }
}
