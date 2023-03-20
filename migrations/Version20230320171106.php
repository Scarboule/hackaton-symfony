<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320171106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lift ADD manual_open TINYINT(1) DEFAULT NULL, ADD manual_close TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE slope ADD manual_close TINYINT(1) DEFAULT NULL, ADD schedule LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE is_open manual_open TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lift DROP manual_open, DROP manual_close');
        $this->addSql('ALTER TABLE slope ADD is_open TINYINT(1) DEFAULT NULL, DROP manual_open, DROP manual_close, DROP schedule');
    }
}
