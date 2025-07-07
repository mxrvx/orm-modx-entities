<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Console\Command;

use MXRVX\ORM\MODX\App;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCommand extends Command
{
    public function configure(): void
    {
        $this
            ->setName('remove')
            ->setDescription(\sprintf('Remove `%s` extra from MODX', App::getNameSpaceSlug()));
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $ns = App::getNameSpaceSlug();

        $corePath = MODX_CORE_PATH . 'components/' . $ns;
        if (\is_dir($corePath)) {
            \unlink($corePath);
            $output->writeln('<info>Removed symlink for `core`</info>');
        }

        if (!\is_dir($corePath)) {
            $output->writeln('<info>The package was successfully uninstalled</info>');
        }

        return Command::SUCCESS;
    }
}
