<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119155644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE work_entry (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3DAE65F9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_entry ADD CONSTRAINT FK_3DAE65F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE work_entry');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
