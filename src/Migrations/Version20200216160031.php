<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216160031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event_thematic (event_id INT NOT NULL, thematic_id INT NOT NULL, INDEX IDX_3AF036A271F7E88B (event_id), INDEX IDX_3AF036A22395FCED (thematic_id), PRIMARY KEY(event_id, thematic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_date (event_id INT NOT NULL, date_id INT NOT NULL, INDEX IDX_B5557BD171F7E88B (event_id), INDEX IDX_B5557BD1B897366B (date_id), PRIMARY KEY(event_id, date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_artiste (event_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_19509CE071F7E88B (event_id), INDEX IDX_19509CE021D25844 (artiste_id), PRIMARY KEY(event_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_media (event_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_2B37102071F7E88B (event_id), INDEX IDX_2B371020EA9FDD75 (media_id), PRIMARY KEY(event_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_organisateur (event_id INT NOT NULL, organisateur_id INT NOT NULL, INDEX IDX_A6C467B771F7E88B (event_id), INDEX IDX_A6C467B7D936B2FA (organisateur_id), PRIMARY KEY(event_id, organisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_place (event_id INT NOT NULL, place_id INT NOT NULL, INDEX IDX_3506E2E171F7E88B (event_id), INDEX IDX_3506E2E1DA6A219 (place_id), PRIMARY KEY(event_id, place_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_group_related (event_id INT NOT NULL, event_group_id INT NOT NULL, INDEX IDX_C20E943071F7E88B (event_id), INDEX IDX_C20E9430B8B83097 (event_group_id), PRIMARY KEY(event_id, event_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_thematic ADD CONSTRAINT FK_3AF036A271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_thematic ADD CONSTRAINT FK_3AF036A22395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_date ADD CONSTRAINT FK_B5557BD171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_date ADD CONSTRAINT FK_B5557BD1B897366B FOREIGN KEY (date_id) REFERENCES date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_artiste ADD CONSTRAINT FK_19509CE071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_artiste ADD CONSTRAINT FK_19509CE021D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_media ADD CONSTRAINT FK_2B37102071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_media ADD CONSTRAINT FK_2B371020EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_organisateur ADD CONSTRAINT FK_A6C467B771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_organisateur ADD CONSTRAINT FK_A6C467B7D936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E1DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_group_related ADD CONSTRAINT FK_C20E943071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_group_related ADD CONSTRAINT FK_C20E9430B8B83097 FOREIGN KEY (event_group_id) REFERENCES event_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD access_type_id INT DEFAULT NULL, ADD member_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D695686 FOREIGN KEY (access_type_id) REFERENCES access_type (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7862A4B61 FOREIGN KEY (member_event_id) REFERENCES member_event (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7D695686 ON event (access_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7862A4B61 ON event (member_event_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE event_thematic');
        $this->addSql('DROP TABLE event_date');
        $this->addSql('DROP TABLE event_artiste');
        $this->addSql('DROP TABLE event_media');
        $this->addSql('DROP TABLE event_organisateur');
        $this->addSql('DROP TABLE event_place');
        $this->addSql('DROP TABLE event_group_related');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7D695686');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7862A4B61');
        $this->addSql('DROP INDEX IDX_3BAE0AA7D695686 ON event');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA7862A4B61 ON event');
        $this->addSql('ALTER TABLE event DROP access_type_id, DROP member_event_id');
    }
}
