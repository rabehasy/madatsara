<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216164443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event_hour (event_id INT NOT NULL, hour_id INT NOT NULL, INDEX IDX_6FD55DE571F7E88B (event_id), INDEX IDX_6FD55DE5B5937BF9 (hour_id), PRIMARY KEY(event_id, hour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hour (id INT AUTO_INCREMENT NOT NULL, hour TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_hour ADD CONSTRAINT FK_6FD55DE571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_hour ADD CONSTRAINT FK_6FD55DE5B5937BF9 FOREIGN KEY (hour_id) REFERENCES hour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_group_related RENAME INDEX idx_8752266971f7e88b TO IDX_C20E943071F7E88B');
        $this->addSql('ALTER TABLE event_group_related RENAME INDEX idx_87522669b8b83097 TO IDX_C20E9430B8B83097');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_hour DROP FOREIGN KEY FK_6FD55DE5B5937BF9');
        $this->addSql('DROP TABLE event_hour');
        $this->addSql('DROP TABLE hour');
        $this->addSql('ALTER TABLE event_group_related RENAME INDEX idx_c20e943071f7e88b TO IDX_8752266971F7E88B');
        $this->addSql('ALTER TABLE event_group_related RENAME INDEX idx_c20e9430b8b83097 TO IDX_87522669B8B83097');
    }
}
