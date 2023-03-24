<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324135228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lost_and_found_object (id INT AUTO_INCREMENT NOT NULL, slope_id INT DEFAULT NULL, description LONGTEXT NOT NULL, found_date DATETIME NOT NULL, INDEX IDX_484EAA849E6329D8 (slope_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lost_and_found_object ADD CONSTRAINT FK_484EAA849E6329D8 FOREIGN KEY (slope_id) REFERENCES slope (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lost_and_found_object DROP FOREIGN KEY FK_484EAA849E6329D8');
        $this->addSql('DROP TABLE lost_and_found_object');
    }
}
