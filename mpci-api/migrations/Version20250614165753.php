<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614165753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE invite (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', poste VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, biographie LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', moderateur_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)', titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_A2ADD30F20A01F78 (moderateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_invite (panel_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', invite_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', INDEX IDX_33E663956F6FCB26 (panel_id), INDEX IDX_33E66395EA417747 (invite_id), PRIMARY KEY(panel_id, invite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30F20A01F78 FOREIGN KEY (moderateur_id) REFERENCES invite (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E663956F6FCB26 FOREIGN KEY (panel_id) REFERENCES panel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E66395EA417747 FOREIGN KEY (invite_id) REFERENCES invite (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30F20A01F78
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP FOREIGN KEY FK_33E663956F6FCB26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP FOREIGN KEY FK_33E66395EA417747
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE invite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel_invite
        SQL);
    }
}
