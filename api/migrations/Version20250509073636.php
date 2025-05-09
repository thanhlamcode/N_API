<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509073636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP CONSTRAINT fk_d34a04ad12469de2
        SQL);
        $this->addSql(<<<'SQL'
            DROP SEQUENCE category_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_d34a04ad12469de2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product DROP category_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services ADD media_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services ADD CONSTRAINT FK_7332E169EA9FDD75 FOREIGN KEY (media_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_7332E169EA9FDD75 ON services (media_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD category_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product ADD CONSTRAINT fk_d34a04ad12469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_d34a04ad12469de2 ON product (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services DROP CONSTRAINT FK_7332E169EA9FDD75
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_7332E169EA9FDD75
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE services DROP media_id
        SQL);
    }
}
