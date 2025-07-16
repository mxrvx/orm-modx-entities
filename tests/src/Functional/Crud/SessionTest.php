<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Functional\Crud;

use MXRVX\ORM\MODX\Entities\Session;
use MXRVX\ORM\MODX\Tests\Functional\CrudTestCase;

/**
 * @extends CrudTestCase<Session>
 */
final class SessionTest extends CrudTestCase
{
    /** @var class-string<Session> */
    protected static string $class = Session::class;

    /** @var string|string[] */
    protected static string|array $pk = 'id';

    protected static array $data = [
        'id' => 'id',
        'access' => 1752662272,
    ];
}
