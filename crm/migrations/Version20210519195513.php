<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210519195513 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tableau_de_bord ADD type_rapport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tableau_de_bord ADD CONSTRAINT FK_38B30D8AF81A63 FOREIGN KEY (type_rapport_id) REFERENCES tableau_de_bord (id)');
        $this->addSql('CREATE INDEX IDX_38B30D8AF81A63 ON tableau_de_bord (type_rapport_id)');
        $this->addSql('ALTER TABLE type_rapport DROP FOREIGN KEY FK_9615CF696D25C725');
        $this->addSql('DROP INDEX IDX_9615CF696D25C725 ON type_rapport');
        $this->addSql('ALTER TABLE type_rapport DROP tableau_de_bord_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tableau_de_bord DROP FOREIGN KEY FK_38B30D8AF81A63');
        $this->addSql('DROP INDEX IDX_38B30D8AF81A63 ON tableau_de_bord');
        $this->addSql('ALTER TABLE tableau_de_bord DROP type_rapport_id');
        $this->addSql('ALTER TABLE type_rapport ADD tableau_de_bord_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_rapport ADD CONSTRAINT FK_9615CF696D25C725 FOREIGN KEY (tableau_de_bord_id) REFERENCES tableau_de_bord (id)');
        $this->addSql('CREATE INDEX IDX_9615CF696D25C725 ON type_rapport (tableau_de_bord_id)');
    }
}
