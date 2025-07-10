<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\User;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<User>
 */
final class UserTest extends CrudTestCase
{
    /** @var class-string<User> */
    protected static string $class = User::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 1,
        'username' => 'username',
        'session_stale' => [['key' => 'value']],
    ];
}
