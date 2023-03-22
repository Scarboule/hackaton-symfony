<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322143306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE weather_report (id INT AUTO_INCREMENT NOT NULL, station_id INT DEFAULT NULL, temperature INT NOT NULL, temperature_range VARCHAR(255) NOT NULL, temperature_felt INT NOT NULL, type VARCHAR(255) NOT NULL, wind INT NOT NULL, humidity INT NOT NULL, uv_index VARCHAR(255) NOT NULL, avalanche_risk VARCHAR(255) NOT NULL, snow_quality VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2A0851E221BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weather_report ADD CONSTRAINT FK_2A0851E221BDB235 FOREIGN KEY (station_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE weather_report DROP FOREIGN KEY FK_2A0851E221BDB235');
        $this->addSql('DROP TABLE weather_report');
    }
}
