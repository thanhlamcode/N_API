<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509103633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE staff_service (id SERIAL NOT NULL, staff_id INT NOT NULL, service_id INT NOT NULL, status BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BD2B8D64D4D57CD ON staff_service (staff_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_BD2B8D64ED5CA9E6 ON staff_service (service_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_service ADD CONSTRAINT FK_BD2B8D64D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_service ADD CONSTRAINT FK_BD2B8D64ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_service DROP CONSTRAINT FK_BD2B8D64D4D57CD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_service DROP CONSTRAINT FK_BD2B8D64ED5CA9E6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE staff_service
        SQL);
    }
}
