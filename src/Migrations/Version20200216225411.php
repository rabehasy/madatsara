<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216225411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artiste ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE organisateur ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic ADD slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artiste DROP slug');
        $this->addSql('ALTER TABLE commune DROP slug');
        $this->addSql('ALTER TABLE organisateur DROP slug');
        $this->addSql('ALTER TABLE place DROP slug');
        $this->addSql('ALTER TABLE region DROP slug');
        $this->addSql('ALTER TABLE thematic DROP slug');
    }
}
