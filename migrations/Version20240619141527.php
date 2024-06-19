<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619141527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE completions DROP FOREIGN KEY FK_AC8B450795EE78BA');
        $this->addSql('DROP INDEX IDX_AC8B450795EE78BA ON completions');
        $this->addSql('ALTER TABLE completions CHANGE challenges_id user_challenges_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE completions ADD CONSTRAINT FK_AC8B45077B60D5EA FOREIGN KEY (user_challenges_id) REFERENCES user_challenges (id)');
        $this->addSql('CREATE INDEX IDX_AC8B45077B60D5EA ON completions (user_challenges_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_challenges CHANGE completion_date completion_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE challenges CHANGE start_date start_date DATETIME DEFAULT \'NULL\', CHANGE end_date end_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE completions DROP FOREIGN KEY FK_AC8B45077B60D5EA');
        $this->addSql('DROP INDEX IDX_AC8B45077B60D5EA ON completions');
        $this->addSql('ALTER TABLE completions CHANGE user_challenges_id challenges_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE completions ADD CONSTRAINT FK_AC8B450795EE78BA FOREIGN KEY (challenges_id) REFERENCES challenges (id)');
        $this->addSql('CREATE INDEX IDX_AC8B450795EE78BA ON completions (challenges_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`, CHANGE picture picture VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user_challenges CHANGE completion_date completion_date DATETIME DEFAULT \'NULL\'');
    }
}
