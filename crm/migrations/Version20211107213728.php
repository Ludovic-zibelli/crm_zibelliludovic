<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211107213728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier_maintenance ADD backgroundcolor VARCHAR(7) NOT NULL, ADD bordercolor VARCHAR(7) NOT NULL, ADD textcolor VARCHAR(7) NOT NULL, ADD freq VARCHAR(100) DEFAULT NULL, ADD `interval` VARCHAR(100) DEFAULT NULL, ADD byweekday VARCHAR(100) DEFAULT NULL, DROP background_color, DROP border_color, DROP text_color, DROP rrule_freq, DROP rrule_interval, DROP rrule_byweekday, CHANGE titre title VARCHAR(255) NOT NULL, CHANGE rrule_dstart dstart DATETIME DEFAULT NULL, CHANGE rrule_until until DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE calendrier_maintenance ADD background_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD border_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD text_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD rrule_freq VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD rrule_interval VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD rrule_byweekday VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP backgroundcolor, DROP bordercolor, DROP textcolor, DROP freq, DROP `interval`, DROP byweekday, CHANGE title titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dstart rrule_dstart DATETIME DEFAULT NULL, CHANGE until rrule_until DATE DEFAULT NULL');
    }
}
