<?php


declare(strict_types=1);

namespace MXRVX\ORM\MODX\Tests\Traits;

use Cycle\Database\DatabaseInterface;
use Cycle\Database\DatabaseManager;
use Cycle\Database\DatabaseProviderInterface;
use Cycle\Database\Driver\DriverInterface;
use Cycle\Database\Driver\HandlerInterface;
use Cycle\Database\Table;
use Cycle\Database\TableInterface;
use Cycle\Migrations\MigrationInterface;
use Cycle\Migrations\Migrator;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\SchemaInterface;
use Cycle\ORM\Select;
use MXRVX\ORM\MigrationPathConfig;
use MXRVX\ORM\MigratorFactory;
use MXRVX\ORM\MODX\App;
use MXRVX\ORM\Tools\Files;

trait DataBaseDependentTrait
{
    public function getDatabase(): DatabaseInterface
    {
        return $this->getContainer()->get(DatabaseInterface::class);
    }

    public function getDatabaseManager(): DatabaseManager
    {
        return $this->getContainer()->get(DatabaseManager::class);
    }

    public function getORM(): ORMInterface
    {
        return $this->getContainer()->get(ORMInterface::class);
    }

    public function getSchemaByRole(string $role): ?array
    {
        return $this->getORM()->getSchema()->toArray()[$role] ?? null;
    }

    public function getTableNameByRole(string $role): ?string
    {
        if ($schema = $this->getSchemaByRole($role)) {
            return $schema[SchemaInterface::TABLE] ?? null;
        }

        return null;
    }

    public function getTableByRole(string $role): ?TableInterface
    {
        if ($name = $this->getTableNameByRole($role)) {
            return $this->getDatabase()->table($name);
        }

        return null;
    }

    public function getDriver(): DriverInterface
    {
        return $this->getDatabase()->getDriver();
    }

    public function getMigratorFactory(): MigratorFactory
    {
        return $this->migratorFactory ??= new MigratorFactory(
            (new MigrationPathConfig())->setNameSpace(App::getNameSpaceSlug()),
            $this->getContainer()->get(DatabaseProviderInterface::class),
        );
    }

    public function getMigrator(): Migrator
    {
        return $this->getMigratorFactory()->get();
    }

    public function getMigrations(): array
    {
        if ($list = $this->getMigrator()->getMigrations()) {
            return $list;
        }

        return [];
    }

    public function runUpMigrations(): void
    {
        do {
            $migration = $this->getMigrator()->run();
            if (!$migration instanceof MigrationInterface) {
                break;
            }

        } while (true);
    }

    public function runDownMigrations(): void
    {
        do {
            $migration = $this->getMigrator()->rollback();
            if (!$migration instanceof MigrationInterface) {
                break;
            }
        } while (true);
    }

    public function cleanUpAfterMigrator(): void
    {
        $migratorFactory = $this->getMigratorFactory();

        Files::deleteDirectory($migratorFactory->getMigrationPathConfig()->getDirectory(), true);
    }

    public function dropTable(?Table $table = null): void
    {
        if ($table === null) {
            return;
        }

        $schema = $table->getSchema();
        $schema->declareDropped();
        $schema->save();
    }

    public function dropDatabase(?DatabaseInterface $database = null): void
    {
        if ($database === null) {
            return;
        }

        foreach ($database->getTables() as $table) {
            $schema = $table->getSchema();

            foreach ($schema->getForeignKeys() as $foreign) {
                $schema->dropForeignKey($foreign->getColumns());
            }

            $schema->save(HandlerInterface::DROP_FOREIGN_KEYS);
        }

        foreach ($database->getTables() as $table) {
            $schema = $table->getSchema();
            $schema->declareDropped();
            $schema->save();
        }
    }

    public function selectEntity(string $role, bool $cleanHeap = false): Select
    {
        $orm = $this->getContainer()->get(ORMInterface::class);

        if ($cleanHeap) {
            $orm->getHeap()->clean();
        }

        return new Select($orm, $role);
    }
}
