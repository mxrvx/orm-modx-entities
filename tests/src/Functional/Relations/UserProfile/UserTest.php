<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Relations\UserProfile;

use MXRVX\ORM\MODX\Entities\User;
use MXRVX\ORM\MODX\Entities\UserProfile;
use MXRVX\ORM\MODX\Tests\Functional\RelationsTestCase;
use PHPUnit\Framework\Attributes\Test;

final class UserTest extends RelationsTestCase
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
        $entity = UserProfile::findOne(['internalKey' => 1]);
        self::assertNotNull($entity);

        $user = $entity->User;

        self::assertNotNull($user);
        self::assertInstanceOf(User::class, $user);
        self::assertEquals($entity->internalKey, $user->id);
    }

    #[Test]
    public function it_get_relation_entity_2(): void
    {
        $entity = UserProfile::findOne(['internalKey' => 2]);
        self::assertNotNull($entity);

        $user = $entity->User;

        self::assertNotNull($user);
        self::assertInstanceOf(User::class, $user);
        self::assertEquals($entity->internalKey, $user->id);
    }

    #[Test]
    public function it_creates_entity_with_relation_1(): void
    {
        $entity = UserProfile::make(['id' => 100, 'fullname' => 'fullname_10', 'email' => 'email_10@mail.ru', 'address' => '', 'comment' => '']);
        $entity->User = User::make(['id' => 10, 'username' => 'username_10', 'primary_group' => 0]);

        self::assertTrue($entity->save());

        $user = User::findOne(['id' => $entity->internalKey]);

        self::assertInstanceOf(User::class, $user);
        self::assertEquals($entity->internalKey, $user->id);
    }

    #[Test]
    public function it_deletes_entities_with_relation_1(): void
    {
        $entity = UserProfile::findOne(['internalKey' => 1]);
        $user = $entity->User;

        self::assertNotNull($user);
        self::assertInstanceOf(User::class, $user);

        UserProfile::transact(static function () use ($entity, $user): void {
            self::assertTrue($entity->delete());
            self::assertTrue($user->delete());
        });

        $profile = User::findOne(['id' => 1]);
        self::assertNull($profile);
    }
}
