<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210502204623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet_societes (projet_id INT NOT NULL, societes_id INT NOT NULL, INDEX IDX_89470EF0C18272 (projet_id), INDEX IDX_89470EF07E841BEA (societes_id), PRIMARY KEY(projet_id, societes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_societes ADD CONSTRAINT FK_89470EF0C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_societes ADD CONSTRAINT FK_89470EF07E841BEA FOREIGN KEY (societes_id) REFERENCES societes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9FCF77503');
        $this->addSql('DROP INDEX IDX_50159CA9FCF77503 ON projet');
        $this->addSql('ALTER TABLE projet DROP societe_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projet_societes');
        $this->addSql('ALTER TABLE projet ADD societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9FCF77503 FOREIGN KEY (societe_id) REFERENCES societes (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9FCF77503 ON projet (societe_id)');
    }
}
