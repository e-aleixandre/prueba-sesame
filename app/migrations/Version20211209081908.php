<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209081908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE core_context_workentry (id CHAR(36) CHARACTER SET ascii NOT NULL, user_id VARCHAR(36) NOT NULL, start_date CHAR(25) CHARACTER SET ascii NOT NULL COMMENT \'(DC2Type:carbon)\', end_date CHAR(25) CHARACTER SET ascii NOT NULL COMMENT \'(DC2Type:carbon)\', created_at CHAR(25) CHARACTER SET ascii NOT NULL COMMENT \'(DC2Type:carbon)\', updated_at CHAR(25) CHARACTER SET ascii NOT NULL COMMENT \'(DC2Type:carbon)\', deleted_at CHAR(25) CHARACTER SET ascii NOT NULL COMMENT \'(DC2Type:carbon)\', INDEX deleted_atx (deleted_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE core_context_workentry');
    }
}
