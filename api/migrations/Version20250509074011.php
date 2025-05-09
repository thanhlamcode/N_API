<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509074011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX uniq_7332e169a21214b7
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7332E169A21214B7 ON services (categories_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7332E169A21214B7
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX uniq_7332e169a21214b7 ON services (categories_id)
        SQL);
    }
}
