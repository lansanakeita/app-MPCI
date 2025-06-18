<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614182338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD evenement_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A2ADD30FFD02F13 ON panel (evenement_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30FFD02F13
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A2ADD30FFD02F13 ON panel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP evenement_id
        SQL);
    }
}
