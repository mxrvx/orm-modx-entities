<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\UserProfile;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<UserProfile>
 */
final class UserProfileTest extends CrudTestCase
{
    /** @var class-string<UserProfile> */
    protected static string $class = UserProfile::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 1,
        'internalKey' => 1,
        'fullname' => 'fullname',
        'email' => 'email@mail.ru',
    ];
}
