<?php

declare(strict_types=1);

if (!\class_exists('\\modX') && \class_exists('\\MODX\\Revolution\\modX')) {
    \class_alias('\\MODX\\Revolution\\modX', '\\modX');
}

if (!\class_exists('\\xPDO') && \class_exists('\\xPDO\\xPDO')) {
    \class_alias('\\xPDO\\xPDO', '\\xPDO');
}
