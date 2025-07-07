<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Console\Command;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class Command extends SymfonyCommand
{
    public const SUCCESS = SymfonyCommand::SUCCESS;
    public const FAILURE = SymfonyCommand::FAILURE;
    public const INVALID = SymfonyCommand::INVALID;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(
        protected Container $container,
        ?string             $name = null,
    ) {
        parent::__construct($name);
    }
}
