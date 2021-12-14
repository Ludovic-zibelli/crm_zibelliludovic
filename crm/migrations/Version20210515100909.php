<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515100909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fichiers ADD fichier_name VARCHAR(255) DEFAULT NULL, ADD fichier_original_name VARCHAR(255) DEFAULT NULL, ADD fichier_mime_type VARCHAR(255) DEFAULT NULL, ADD fichier_size INT DEFAULT NULL, ADD fichier_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', DROP nom, DROP chemin_acces, CHANGE created_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fichiers ADD nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD chemin_acces VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP fichier_name, DROP fichier_original_name, DROP fichier_mime_type, DROP fichier_size, DROP fichier_dimensions, CHANGE updated_at created_at DATETIME NOT NULL');
    }
}
