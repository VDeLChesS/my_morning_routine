<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617004758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE routine_activities (id INT AUTO_INCREMENT NOT NULL, routine_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, activity_order INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EC8DD673F27A94C7 (routine_id), INDEX IDX_EC8DD67381C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE routine_activities ADD CONSTRAINT FK_EC8DD673F27A94C7 FOREIGN KEY (routine_id) REFERENCES morning_routines (id)');
        $this->addSql('ALTER TABLE routine_activities ADD CONSTRAINT FK_EC8DD67381C06096 FOREIGN KEY (activity_id) REFERENCES activities (id)');
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE routine_activities DROP FOREIGN KEY FK_EC8DD673F27A94C7');
        $this->addSql('ALTER TABLE routine_activities DROP FOREIGN KEY FK_EC8DD67381C06096');
        $this->addSql('DROP TABLE routine_activities');
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE end_date end_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE picture picture VARCHAR(255) DEFAULT \'NULL\'');
    }
}
