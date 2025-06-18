<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250615090447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE programme_image (id INT AUTO_INCREMENT NOT NULL, evenement_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)', image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_F6275988FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image ADD CONSTRAINT FK_F6275988FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenement DROP agenda
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image DROP FOREIGN KEY FK_F6275988FD02F13
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE programme_image
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenement ADD agenda VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
