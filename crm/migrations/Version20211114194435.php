<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211114194435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier_maintenance ADD rrufreq VARCHAR(100) DEFAULT NULL, ADD rruinterval VARCHAR(100) DEFAULT NULL, ADD rrubyweekday VARCHAR(100) DEFAULT NULL, DROP freq, DROP `interval`, DROP byweekday, CHANGE dstart rrudstart DATETIME DEFAULT NULL, CHANGE until rruuntil DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier_maintenance ADD freq VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD `interval` VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD byweekday VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP rrufreq, DROP rruinterval, DROP rrubyweekday, CHANGE rrudstart dstart DATETIME DEFAULT NULL, CHANGE rruuntil until DATE DEFAULT NULL');
    }
}
