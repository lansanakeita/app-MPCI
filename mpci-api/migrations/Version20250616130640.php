<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616130640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30F20A01F78
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30F20A01F78 FOREIGN KEY (moderateur_id) REFERENCES invite (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image CHANGE evenement_id evenement_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30F20A01F78
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30F20A01F78 FOREIGN KEY (moderateur_id) REFERENCES invite (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image CHANGE evenement_id evenement_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)'
        SQL);
    }
}
