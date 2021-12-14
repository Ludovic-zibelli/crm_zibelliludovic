<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416205843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, created_at DATETIME NOT NULL, numero_de_facture VARCHAR(255) NOT NULL, date_de_paiement DATETIME NOT NULL, payer TINYINT(1) NOT NULL, montant_facture DOUBLE PRECISION NOT NULL, INDEX IDX_647590BC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fichiers (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, chemin_acces VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_969DB4ABC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interlocuteurs (id INT AUTO_INCREMENT NOT NULL, societe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_27EED0CEFCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, societe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, type_projet VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, date_modification DATETIME NOT NULL, langage VARCHAR(255) NOT NULL, avancement_projet VARCHAR(255) NOT NULL, description_projet LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_50159CA9FCF77503 (societe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societes (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, numero_siret VARCHAR(255) DEFAULT NULL, genre_de_societe VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, autre_infos LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tableau_de_bord (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, auteur VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, date_modification DATETIME NOT NULL, INDEX IDX_38B30D8AA76ED395 (user_id), INDEX IDX_38B30D8AC18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_rapport (id INT AUTO_INCREMENT NOT NULL, tableau_de_bord_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9615CF696D25C725 (tableau_de_bord_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, date_modification DATETIME NOT NULL, poste VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590BC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE fichiers ADD CONSTRAINT FK_969DB4ABC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE interlocuteurs ADD CONSTRAINT FK_27EED0CEFCF77503 FOREIGN KEY (societe_id) REFERENCES societes (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9FCF77503 FOREIGN KEY (societe_id) REFERENCES societes (id)');
        $this->addSql('ALTER TABLE tableau_de_bord ADD CONSTRAINT FK_38B30D8AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tableau_de_bord ADD CONSTRAINT FK_38B30D8AC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE type_rapport ADD CONSTRAINT FK_9615CF696D25C725 FOREIGN KEY (tableau_de_bord_id) REFERENCES tableau_de_bord (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590BC18272');
        $this->addSql('ALTER TABLE fichiers DROP FOREIGN KEY FK_969DB4ABC18272');
        $this->addSql('ALTER TABLE tableau_de_bord DROP FOREIGN KEY FK_38B30D8AC18272');
        $this->addSql('ALTER TABLE interlocuteurs DROP FOREIGN KEY FK_27EED0CEFCF77503');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9FCF77503');
        $this->addSql('ALTER TABLE type_rapport DROP FOREIGN KEY FK_9615CF696D25C725');
        $this->addSql('ALTER TABLE tableau_de_bord DROP FOREIGN KEY FK_38B30D8AA76ED395');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE fichiers');
        $this->addSql('DROP TABLE interlocuteurs');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE societes');
        $this->addSql('DROP TABLE tableau_de_bord');
        $this->addSql('DROP TABLE type_rapport');
        $this->addSql('DROP TABLE user');
    }
}
