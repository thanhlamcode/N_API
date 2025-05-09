<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250508073949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE staff_permission_link (id SERIAL NOT NULL, staff_id INT DEFAULT NULL, permission_id INT DEFAULT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E4F2AD93D4D57CD ON staff_permission_link (staff_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_E4F2AD93FED90CCA ON staff_permission_link (permission_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permission_link ADD CONSTRAINT FK_E4F2AD93D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permission_link ADD CONSTRAINT FK_E4F2AD93FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permissions DROP CONSTRAINT fk_dcdf7c3dd4d57cd
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permissions DROP CONSTRAINT fk_dcdf7c3dfed90cca
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE staff_permissions
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE permission DROP is_granted
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE staff_permissions (permission_id INT NOT NULL, staff_id INT NOT NULL, PRIMARY KEY(permission_id, staff_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_dcdf7c3dfed90cca ON staff_permissions (permission_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_dcdf7c3dd4d57cd ON staff_permissions (staff_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permissions ADD CONSTRAINT fk_dcdf7c3dd4d57cd FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permissions ADD CONSTRAINT fk_dcdf7c3dfed90cca FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permission_link DROP CONSTRAINT FK_E4F2AD93D4D57CD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE staff_permission_link DROP CONSTRAINT FK_E4F2AD93FED90CCA
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE staff_permission_link
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE permission ADD is_granted BOOLEAN NOT NULL
        SQL);
    }
}
