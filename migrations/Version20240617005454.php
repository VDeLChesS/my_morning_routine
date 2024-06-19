<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617005454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_rewards (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reward_id INT DEFAULT NULL, earned_at DATETIME NOT NULL, INDEX IDX_B12F003DA76ED395 (user_id), INDEX IDX_B12F003DE466ACA1 (reward_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_rewards ADD CONSTRAINT FK_B12F003DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_rewards ADD CONSTRAINT FK_B12F003DE466ACA1 FOREIGN KEY (reward_id) REFERENCES rewards (id)');
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_rewards DROP FOREIGN KEY FK_B12F003DA76ED395');
        $this->addSql('ALTER TABLE user_rewards DROP FOREIGN KEY FK_B12F003DE466ACA1');
        $this->addSql('DROP TABLE user_rewards');
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE end_date end_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE picture picture VARCHAR(255) DEFAULT \'NULL\'');
    }
}
