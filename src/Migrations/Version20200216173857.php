<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216173857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE place ADD region_id INT DEFAULT NULL, ADD commune_id INT DEFAULT NULL, ADD quartier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD98260155 ON place (region_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD131A4F72 ON place (commune_id)');
        $this->addSql('CREATE INDEX IDX_741D53CDDF1E57AB ON place (quartier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD98260155');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD131A4F72');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDDF1E57AB');
        $this->addSql('DROP INDEX IDX_741D53CD98260155 ON place');
        $this->addSql('DROP INDEX IDX_741D53CD131A4F72 ON place');
        $this->addSql('DROP INDEX IDX_741D53CDDF1E57AB ON place');
        $this->addSql('ALTER TABLE place DROP region_id, DROP commune_id, DROP quartier_id');
    }
}
