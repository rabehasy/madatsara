<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216180743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artiste_artiste (artiste_source INT NOT NULL, artiste_target INT NOT NULL, INDEX IDX_EB5A742F5FB8972 (artiste_source), INDEX IDX_EB5A742F1C1ED9FD (artiste_target), PRIMARY KEY(artiste_source, artiste_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_artiste ADD CONSTRAINT FK_EB5A742F5FB8972 FOREIGN KEY (artiste_source) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_artiste ADD CONSTRAINT FK_EB5A742F1C1ED9FD FOREIGN KEY (artiste_target) REFERENCES artiste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE artiste_artiste');
        $this->addSql('ALTER TABLE artiste ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354F727ACA70 FOREIGN KEY (parent_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_9C07354F727ACA70 ON artiste (parent_id)');
    }
}
