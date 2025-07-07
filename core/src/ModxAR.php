<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX;

use MXRVX\ORM\AR\AR;

abstract class ModxAR extends AR implements ModxARInterface
{
    public function delete(bool $cascade = false): bool
    {
        return parent::delete($cascade);
    }
}
