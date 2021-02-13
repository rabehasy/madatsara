<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216193132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE api ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE keyword_search ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE member_event ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organisateur ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE status ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE subscriber ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE thematic ADD deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE api DROP deleted_at');
        $this->addSql('ALTER TABLE artiste DROP deleted_at');
        $this->addSql('ALTER TABLE commune DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE event DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE keyword_search DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE media DROP deleted_at');
        $this->addSql('ALTER TABLE member_event DROP deleted_at');
        $this->addSql('ALTER TABLE organisateur DROP deleted_at');
        $this->addSql('ALTER TABLE place DROP deleted_at');
        $this->addSql('ALTER TABLE quartier DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE region DROP deleted_at');
        $this->addSql('ALTER TABLE status DROP deleted_at');
        $this->addSql('ALTER TABLE subscriber DROP deleted_at');
        $this->addSql('ALTER TABLE thematic DROP deleted_at');
    }
}
