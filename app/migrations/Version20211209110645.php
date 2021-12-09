<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209110645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE core_context_workentry CHANGE end_date end_date CHAR(25) CHARACTER SET ascii DEFAULT NULL COMMENT \'(DC2Type:carbon)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE core_context_workentry CHANGE end_date end_date CHAR(25) CHARACTER SET ascii NOT NULL COLLATE `ascii_general_ci` COMMENT \'(DC2Type:carbon)\'');
    }
}
