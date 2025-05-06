<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506071240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE staff (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, nickname VARCHAR(255) NOT NULL, code VARCHAR(50) NOT NULL, active_status BOOLEAN NOT NULL, booking_status BOOLEAN NOT NULL, commission_or_salary NUMERIC(10, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_426EF39277153098 ON staff (code)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN staff.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE staff
        SQL);
    }
}
