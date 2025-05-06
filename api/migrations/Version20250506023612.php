<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506023612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX uniq_d34a04adea9fdd75
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D34A04ADEA9FDD75 ON product (media_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_D34A04ADEA9FDD75
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX uniq_d34a04adea9fdd75 ON product (media_id)
        SQL);
    }
}
