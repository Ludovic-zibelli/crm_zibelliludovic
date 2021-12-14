<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523124657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tableau_de_bord DROP FOREIGN KEY FK_38B30D8AF81A63');
        $this->addSql('ALTER TABLE tableau_de_bord CHANGE auteur titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tableau_de_bord ADD CONSTRAINT FK_38B30D8AF81A63 FOREIGN KEY (type_rapport_id) REFERENCES type_rapport (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tableau_de_bord DROP FOREIGN KEY FK_38B30D8AF81A63');
        $this->addSql('ALTER TABLE tableau_de_bord CHANGE titre auteur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tableau_de_bord ADD CONSTRAINT FK_38B30D8AF81A63 FOREIGN KEY (type_rapport_id) REFERENCES tableau_de_bord (id)');
    }
}
