<?php

declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests;

use Cycle\Schema\Generator\Migrations\GenerateMigrations;
use Cycle\Schema\Generator\Migrations\NameBasedOnChangesGenerator;
use Cycle\Schema\Generator\Migrations\Strategy\MultipleFilesStrategy;
use Cycle\Schema;
use MXRVX\ORM\Config\ConnectionConfig;
use MXRVX\ORM\Config\DatabaseConfig;
use MXRVX\ORM\GeneratorsFactory;
use MXRVX\ORM\MigratorFactory;
use MXRVX\ORM\MODX\Tests\Traits\DataBaseDependentTrait;
use MXRVX\ORM\MODX\Tests\Traits\LoggerTrait;

abstract class DatabaseTestCase extends TestCase
{
    use LoggerTrait;
    use DataBaseDependentTrait;

    public ?MigratorFactory $migratorFactory = null;

    /**
     * @throws \Throwable
     */
    protected function setUp(): void
    {
        parent::setUp();

        $dbConfig = $this->getContainer()->get(DatabaseConfig::class);

        $testConnection = new ConnectionConfig(
            host: \getenv('DB_HOST'),
            port: \getenv('DB_PORT'),
            user: \getenv('DB_USERNAME'),
            password: \getenv('DB_PASSWORD'),
            database: \getenv('DB_NAME'),
            prefix: \getenv('DB_PREFIX'),
        );

        $dbConfig->addConnection('modx', $testConnection);

        if ($this->getDatabase()->getPrefix() !== \getenv('DB_PREFIX')) {
            throw new \RuntimeException('Is not Test Database');
        }

        $this->dropDatabase($this->getDatabase());

        $this->setUpLogger($this->getDriver());

        $migratorFactory = $this->getMigratorFactory();
        $registry = new Schema\Registry($migratorFactory->getDatabaseManager());
        $compiler = new Schema\Compiler();
        $factory = (new GeneratorsFactory($migratorFactory->getMigrationPathConfig()))
            ->addGenerator('migration', new GenerateMigrations(
                repository: $this->getMigrator()->getRepository(),
                migrationConfig: $this->getMigrator()->getConfig(),
                strategy: new MultipleFilesStrategy($this->getMigrator()->getConfig(), new NameBasedOnChangesGenerator()),
            ));

        $schema = $compiler->compile($registry, $factory->get());
        if (empty($schema)) {
            throw new \RuntimeException('Schema is empty');
        }

        $this->runUpMigrations();

        if (\getenv('DEBUG') === '1') {
            $this->enableProfiling();
        }
    }

    /**
     * @throws \Throwable
     */
    protected function tearDown(): void
    {
        $this->disableProfiling();
        $this->runDownMigrations();
        $this->cleanUpAfterMigrator();
        $this->getDatabase()->getDriver()->disconnect();

        \Cycle\ActiveRecord\Facade::reset();

        parent::tearDown();
    }
}
