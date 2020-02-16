<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216204251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE artiste_media (artiste_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_1E05BBF221D25844 (artiste_id), INDEX IDX_1E05BBF2EA9FDD75 (media_id), PRIMARY KEY(artiste_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisateur_media (organisateur_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_D2335517D936B2FA (organisateur_id), INDEX IDX_D2335517EA9FDD75 (media_id), PRIMARY KEY(organisateur_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_media ADD CONSTRAINT FK_1E05BBF221D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_media ADD CONSTRAINT FK_1E05BBF2EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisateur_media ADD CONSTRAINT FK_D2335517D936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisateur_media ADD CONSTRAINT FK_D2335517EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_group ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_group ADD CONSTRAINT FK_2CDBF5E9727ACA70 FOREIGN KEY (parent_id) REFERENCES event_group (id)');
        $this->addSql('CREATE INDEX IDX_2CDBF5E9727ACA70 ON event_group (parent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE artiste_media');
        $this->addSql('DROP TABLE organisateur_media');
        $this->addSql('ALTER TABLE event_group DROP FOREIGN KEY FK_2CDBF5E9727ACA70');
        $this->addSql('DROP INDEX IDX_2CDBF5E9727ACA70 ON event_group');
        $this->addSql('ALTER TABLE event_group DROP parent_id');
    }
}
