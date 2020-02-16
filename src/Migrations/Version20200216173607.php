<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216173607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commune CHANGE country country VARCHAR(4) DEFAULT NULL');
        $this->addSql('ALTER TABLE place DROP region, DROP commune, DROP quartier, CHANGE country country VARCHAR(4) DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier CHANGE country country VARCHAR(4) DEFAULT NULL');
        $this->addSql('ALTER TABLE region CHANGE country country VARCHAR(4) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commune CHANGE country country VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE place ADD region INT DEFAULT NULL, ADD commune INT DEFAULT NULL, ADD quartier INT DEFAULT NULL, CHANGE country country INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier CHANGE country country VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE region CHANGE country country VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
