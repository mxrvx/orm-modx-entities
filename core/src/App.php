<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX;

class App
{
    public function __construct() {}

    public static function getNameSpace(): string
    {
        return 'MXRVX\\ORM\\MODX\\Entities';
    }

    public static function getNameSpaceSlug(): string
    {
        return \strtolower(\str_replace('\\', '-', self::getNameSpace()));
    }

    public static function getNameSpacePascalCase(): string
    {
        return \str_replace(' ', '', \ucwords(\strtolower(\str_replace('\\', ' ', self::getNameSpace()))));
    }
}
