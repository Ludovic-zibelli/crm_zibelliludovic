<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030170028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendrier_maintenance (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, creatd_at DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, rrule_freq VARCHAR(100) DEFAULT NULL, rrule_interval VARCHAR(100) DEFAULT NULL, rrule_byweekday VARCHAR(100) DEFAULT NULL, rrule_dstart DATETIME DEFAULT NULL, rrule_until DATE DEFAULT NULL, INDEX IDX_CCFC567EC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calendrier_maintenance ADD CONSTRAINT FK_CCFC567EC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE calendrier_maintenance');
    }
}
