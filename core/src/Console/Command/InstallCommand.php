<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Console\Command;

use MXRVX\ORM\MODX\App;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class InstallCommand extends Command
{
    public function configure(): void
    {
        $this
            ->setName('install')
            ->setDescription(\sprintf('Install `%s` extra for MODX', App::getNameSpaceSlug()));
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$input->isInteractive()) {
            throw new \RuntimeException('Only for testing, no need to install on a production project');
        }

        $question = new ConfirmationQuestion('Do you want to install a testing and development package? (yes/no) ', false);

        /** @var QuestionHelper $qaHelper */
        $qaHelper = $this->getHelper('question');
        $answer = (bool) $qaHelper->ask($input, $output, $question);

        if (!$answer) {
            $output->writeln('<info>Package installation aborted</info>');
            return Command::SUCCESS;
        }

        $ns = App::getNameSpaceSlug();

        $srcPath = MODX_CORE_PATH . 'vendor/' . (string) \preg_replace('/-/', '/', $ns, 1);
        $corePath = MODX_CORE_PATH . 'components/' . $ns;
        if (!\is_dir($corePath)) {
            \symlink($srcPath . '/core', $corePath);
            $output->writeln('<info>Created symlink for `core`</info>');
        }

        if (\is_dir($corePath)) {
            $output->writeln('<info>The package has been successfully installed</info>');
        }


        return Command::SUCCESS;
    }
}
