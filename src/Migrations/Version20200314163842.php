<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200314163842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE access_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE api_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE artiste_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commune_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE date_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fake_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hour_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE keyword_search_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE member_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE organisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quartier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscriber_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE thematic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE access_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE api (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE artiste (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE artiste_artiste (artiste_source INT NOT NULL, artiste_target INT NOT NULL, PRIMARY KEY(artiste_source, artiste_target))');
        $this->addSql('CREATE INDEX IDX_EB5A742F5FB8972 ON artiste_artiste (artiste_source)');
        $this->addSql('CREATE INDEX IDX_EB5A742F1C1ED9FD ON artiste_artiste (artiste_target)');
        $this->addSql('CREATE TABLE artiste_media (artiste_id INT NOT NULL, media_id INT NOT NULL, PRIMARY KEY(artiste_id, media_id))');
        $this->addSql('CREATE INDEX IDX_1E05BBF221D25844 ON artiste_media (artiste_id)');
        $this->addSql('CREATE INDEX IDX_1E05BBF2EA9FDD75 ON artiste_media (media_id)');
        $this->addSql('CREATE TABLE commune (id INT NOT NULL, region_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(4) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2E2D1EE98260155 ON commune (region_id)');
        $this->addSql('CREATE TABLE date (id INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, api_id INT DEFAULT NULL, access_type_id INT DEFAULT NULL, member_event_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BAE0AA754963938 ON event (api_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7D695686 ON event (access_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA7862A4B61 ON event (member_event_id)');
        $this->addSql('CREATE TABLE event_thematic (event_id INT NOT NULL, thematic_id INT NOT NULL, PRIMARY KEY(event_id, thematic_id))');
        $this->addSql('CREATE INDEX IDX_3AF036A271F7E88B ON event_thematic (event_id)');
        $this->addSql('CREATE INDEX IDX_3AF036A22395FCED ON event_thematic (thematic_id)');
        $this->addSql('CREATE TABLE event_date (event_id INT NOT NULL, date_id INT NOT NULL, PRIMARY KEY(event_id, date_id))');
        $this->addSql('CREATE INDEX IDX_B5557BD171F7E88B ON event_date (event_id)');
        $this->addSql('CREATE INDEX IDX_B5557BD1B897366B ON event_date (date_id)');
        $this->addSql('CREATE TABLE event_artiste (event_id INT NOT NULL, artiste_id INT NOT NULL, PRIMARY KEY(event_id, artiste_id))');
        $this->addSql('CREATE INDEX IDX_19509CE071F7E88B ON event_artiste (event_id)');
        $this->addSql('CREATE INDEX IDX_19509CE021D25844 ON event_artiste (artiste_id)');
        $this->addSql('CREATE TABLE event_media (event_id INT NOT NULL, media_id INT NOT NULL, PRIMARY KEY(event_id, media_id))');
        $this->addSql('CREATE INDEX IDX_2B37102071F7E88B ON event_media (event_id)');
        $this->addSql('CREATE INDEX IDX_2B371020EA9FDD75 ON event_media (media_id)');
        $this->addSql('CREATE TABLE event_organisateur (event_id INT NOT NULL, organisateur_id INT NOT NULL, PRIMARY KEY(event_id, organisateur_id))');
        $this->addSql('CREATE INDEX IDX_A6C467B771F7E88B ON event_organisateur (event_id)');
        $this->addSql('CREATE INDEX IDX_A6C467B7D936B2FA ON event_organisateur (organisateur_id)');
        $this->addSql('CREATE TABLE event_place (event_id INT NOT NULL, place_id INT NOT NULL, PRIMARY KEY(event_id, place_id))');
        $this->addSql('CREATE INDEX IDX_3506E2E171F7E88B ON event_place (event_id)');
        $this->addSql('CREATE INDEX IDX_3506E2E1DA6A219 ON event_place (place_id)');
        $this->addSql('CREATE TABLE event_group_related (event_id INT NOT NULL, event_group_id INT NOT NULL, PRIMARY KEY(event_id, event_group_id))');
        $this->addSql('CREATE INDEX IDX_C20E943071F7E88B ON event_group_related (event_id)');
        $this->addSql('CREATE INDEX IDX_C20E9430B8B83097 ON event_group_related (event_group_id)');
        $this->addSql('CREATE TABLE event_hour (event_id INT NOT NULL, hour_id INT NOT NULL, PRIMARY KEY(event_id, hour_id))');
        $this->addSql('CREATE INDEX IDX_6FD55DE571F7E88B ON event_hour (event_id)');
        $this->addSql('CREATE INDEX IDX_6FD55DE5B5937BF9 ON event_hour (hour_id)');
        $this->addSql('CREATE TABLE event_group (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_parent BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2CDBF5E9727ACA70 ON event_group (parent_id)');
        $this->addSql('CREATE TABLE fake_data (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, age INT DEFAULT NULL, hidden BOOLEAN DEFAULT NULL, creele TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hour (id INT NOT NULL, hour TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE keyword_search (id INT NOT NULL, name VARCHAR(255) NOT NULL, hits INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, file VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE member_event (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, event INT DEFAULT NULL, status INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE organisateur (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE organisateur_media (organisateur_id INT NOT NULL, media_id INT NOT NULL, PRIMARY KEY(organisateur_id, media_id))');
        $this->addSql('CREATE INDEX IDX_D2335517D936B2FA ON organisateur_media (organisateur_id)');
        $this->addSql('CREATE INDEX IDX_D2335517EA9FDD75 ON organisateur_media (media_id)');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, region_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, quartier_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, address TEXT DEFAULT NULL, gps VARCHAR(255) DEFAULT NULL, country VARCHAR(4) DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_741D53CD98260155 ON place (region_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD131A4F72 ON place (commune_id)');
        $this->addSql('CREATE INDEX IDX_741D53CDDF1E57AB ON place (quartier_id)');
        $this->addSql('CREATE TABLE place_media (place_id INT NOT NULL, media_id INT NOT NULL, PRIMARY KEY(place_id, media_id))');
        $this->addSql('CREATE INDEX IDX_C35ABA2FDA6A219 ON place_media (place_id)');
        $this->addSql('CREATE INDEX IDX_C35ABA2FEA9FDD75 ON place_media (media_id)');
        $this->addSql('CREATE TABLE quartier (id INT NOT NULL, commune_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(4) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEE8962D131A4F72 ON quartier (commune_id)');
        $this->addSql('CREATE TABLE region (id INT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(4) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE status (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE subscriber (id INT NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE thematic (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE artiste_artiste ADD CONSTRAINT FK_EB5A742F5FB8972 FOREIGN KEY (artiste_source) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE artiste_artiste ADD CONSTRAINT FK_EB5A742F1C1ED9FD FOREIGN KEY (artiste_target) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE artiste_media ADD CONSTRAINT FK_1E05BBF221D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE artiste_media ADD CONSTRAINT FK_1E05BBF2EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EE98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA754963938 FOREIGN KEY (api_id) REFERENCES api (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D695686 FOREIGN KEY (access_type_id) REFERENCES access_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7862A4B61 FOREIGN KEY (member_event_id) REFERENCES member_event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_thematic ADD CONSTRAINT FK_3AF036A271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_thematic ADD CONSTRAINT FK_3AF036A22395FCED FOREIGN KEY (thematic_id) REFERENCES thematic (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_date ADD CONSTRAINT FK_B5557BD171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_date ADD CONSTRAINT FK_B5557BD1B897366B FOREIGN KEY (date_id) REFERENCES date (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_artiste ADD CONSTRAINT FK_19509CE071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_artiste ADD CONSTRAINT FK_19509CE021D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_media ADD CONSTRAINT FK_2B37102071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_media ADD CONSTRAINT FK_2B371020EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_organisateur ADD CONSTRAINT FK_A6C467B771F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_organisateur ADD CONSTRAINT FK_A6C467B7D936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E1DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_group_related ADD CONSTRAINT FK_C20E943071F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_group_related ADD CONSTRAINT FK_C20E9430B8B83097 FOREIGN KEY (event_group_id) REFERENCES event_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_hour ADD CONSTRAINT FK_6FD55DE571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_hour ADD CONSTRAINT FK_6FD55DE5B5937BF9 FOREIGN KEY (hour_id) REFERENCES hour (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event_group ADD CONSTRAINT FK_2CDBF5E9727ACA70 FOREIGN KEY (parent_id) REFERENCES event_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE organisateur_media ADD CONSTRAINT FK_D2335517D936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE organisateur_media ADD CONSTRAINT FK_D2335517EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place_media ADD CONSTRAINT FK_C35ABA2FDA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place_media ADD CONSTRAINT FK_C35ABA2FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA7D695686');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA754963938');
        $this->addSql('ALTER TABLE artiste_artiste DROP CONSTRAINT FK_EB5A742F5FB8972');
        $this->addSql('ALTER TABLE artiste_artiste DROP CONSTRAINT FK_EB5A742F1C1ED9FD');
        $this->addSql('ALTER TABLE artiste_media DROP CONSTRAINT FK_1E05BBF221D25844');
        $this->addSql('ALTER TABLE event_artiste DROP CONSTRAINT FK_19509CE021D25844');
        $this->addSql('ALTER TABLE place DROP CONSTRAINT FK_741D53CD131A4F72');
        $this->addSql('ALTER TABLE quartier DROP CONSTRAINT FK_FEE8962D131A4F72');
        $this->addSql('ALTER TABLE event_date DROP CONSTRAINT FK_B5557BD1B897366B');
        $this->addSql('ALTER TABLE event_thematic DROP CONSTRAINT FK_3AF036A271F7E88B');
        $this->addSql('ALTER TABLE event_date DROP CONSTRAINT FK_B5557BD171F7E88B');
        $this->addSql('ALTER TABLE event_artiste DROP CONSTRAINT FK_19509CE071F7E88B');
        $this->addSql('ALTER TABLE event_media DROP CONSTRAINT FK_2B37102071F7E88B');
        $this->addSql('ALTER TABLE event_organisateur DROP CONSTRAINT FK_A6C467B771F7E88B');
        $this->addSql('ALTER TABLE event_place DROP CONSTRAINT FK_3506E2E171F7E88B');
        $this->addSql('ALTER TABLE event_group_related DROP CONSTRAINT FK_C20E943071F7E88B');
        $this->addSql('ALTER TABLE event_hour DROP CONSTRAINT FK_6FD55DE571F7E88B');
        $this->addSql('ALTER TABLE event_group_related DROP CONSTRAINT FK_C20E9430B8B83097');
        $this->addSql('ALTER TABLE event_group DROP CONSTRAINT FK_2CDBF5E9727ACA70');
        $this->addSql('ALTER TABLE event_hour DROP CONSTRAINT FK_6FD55DE5B5937BF9');
        $this->addSql('ALTER TABLE artiste_media DROP CONSTRAINT FK_1E05BBF2EA9FDD75');
        $this->addSql('ALTER TABLE event_media DROP CONSTRAINT FK_2B371020EA9FDD75');
        $this->addSql('ALTER TABLE organisateur_media DROP CONSTRAINT FK_D2335517EA9FDD75');
        $this->addSql('ALTER TABLE place_media DROP CONSTRAINT FK_C35ABA2FEA9FDD75');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA7862A4B61');
        $this->addSql('ALTER TABLE event_organisateur DROP CONSTRAINT FK_A6C467B7D936B2FA');
        $this->addSql('ALTER TABLE organisateur_media DROP CONSTRAINT FK_D2335517D936B2FA');
        $this->addSql('ALTER TABLE event_place DROP CONSTRAINT FK_3506E2E1DA6A219');
        $this->addSql('ALTER TABLE place_media DROP CONSTRAINT FK_C35ABA2FDA6A219');
        $this->addSql('ALTER TABLE place DROP CONSTRAINT FK_741D53CDDF1E57AB');
        $this->addSql('ALTER TABLE commune DROP CONSTRAINT FK_E2E2D1EE98260155');
        $this->addSql('ALTER TABLE place DROP CONSTRAINT FK_741D53CD98260155');
        $this->addSql('ALTER TABLE event_thematic DROP CONSTRAINT FK_3AF036A22395FCED');
        $this->addSql('DROP SEQUENCE access_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE api_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE artiste_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commune_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE date_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fake_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hour_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE keyword_search_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE member_event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE organisateur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quartier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscriber_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE thematic_id_seq CASCADE');
        $this->addSql('DROP TABLE access_type');
        $this->addSql('DROP TABLE api');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE artiste_artiste');
        $this->addSql('DROP TABLE artiste_media');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE date');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_thematic');
        $this->addSql('DROP TABLE event_date');
        $this->addSql('DROP TABLE event_artiste');
        $this->addSql('DROP TABLE event_media');
        $this->addSql('DROP TABLE event_organisateur');
        $this->addSql('DROP TABLE event_place');
        $this->addSql('DROP TABLE event_group_related');
        $this->addSql('DROP TABLE event_hour');
        $this->addSql('DROP TABLE event_group');
        $this->addSql('DROP TABLE fake_data');
        $this->addSql('DROP TABLE hour');
        $this->addSql('DROP TABLE keyword_search');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE member_event');
        $this->addSql('DROP TABLE organisateur');
        $this->addSql('DROP TABLE organisateur_media');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE place_media');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE subscriber');
        $this->addSql('DROP TABLE thematic');
    }
}
