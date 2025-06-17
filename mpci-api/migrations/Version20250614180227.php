<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250614180227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_invite (panel_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', invite_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', INDEX IDX_33E663956F6FCB26 (panel_id), INDEX IDX_33E66395EA417747 (invite_id), PRIMARY KEY(panel_id, invite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_conferencier (panel_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', invite_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', INDEX IDX_93FCB40F6F6FCB26 (panel_id), INDEX IDX_93FCB40FEA417747 (invite_id), PRIMARY KEY(panel_id, invite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E663956F6FCB26 FOREIGN KEY (panel_id) REFERENCES panel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E66395EA417747 FOREIGN KEY (invite_id) REFERENCES invite (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier ADD CONSTRAINT FK_93FCB40F6F6FCB26 FOREIGN KEY (panel_id) REFERENCES panel (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier ADD CONSTRAINT FK_93FCB40FEA417747 FOREIGN KEY (invite_id) REFERENCES invite (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP FOREIGN KEY FK_33E663956F6FCB26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP FOREIGN KEY FK_33E66395EA417747
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier DROP FOREIGN KEY FK_93FCB40F6F6FCB26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier DROP FOREIGN KEY FK_93FCB40FEA417747
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel_invite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel_conferencier
        SQL);
    }
}
