<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616235611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etape_evenement (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', jour_evenement_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', titre VARCHAR(255) NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, activites LONGTEXT DEFAULT NULL, INDEX IDX_2635DDF15BA88BA0 (jour_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evenement (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', titre VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, date_debut DATE NOT NULL COMMENT '(DC2Type:date_immutable)', date_fin DATE NOT NULL COMMENT '(DC2Type:date_immutable)', date_creation DATE NOT NULL COMMENT '(DC2Type:date_immutable)', actif TINYINT(1) NOT NULL, lien_video LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE invite (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', poste VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, biographie LONGTEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE jour_evenement (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', evenement_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', date DATE NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_19459FBDFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', moderateur_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)', evenement_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:ulid)', titre VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_A2ADD30F20A01F78 (moderateur_id), INDEX IDX_A2ADD30FFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_invite (panel_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', invite_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', INDEX IDX_33E663956F6FCB26 (panel_id), INDEX IDX_33E66395EA417747 (invite_id), PRIMARY KEY(panel_id, invite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_conferencier (panel_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', invite_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', INDEX IDX_93FCB40F6F6FCB26 (panel_id), INDEX IDX_93FCB40FEA417747 (invite_id), PRIMARY KEY(panel_id, invite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE participant (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', evenement_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_D79F6B11FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE programme_image (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', evenement_id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_F6275988FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id BINARY(16) NOT NULL COMMENT '(DC2Type:ulid)', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_evenement ADD CONSTRAINT FK_2635DDF15BA88BA0 FOREIGN KEY (jour_evenement_id) REFERENCES jour_evenement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE jour_evenement ADD CONSTRAINT FK_19459FBDFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30F20A01F78 FOREIGN KEY (moderateur_id) REFERENCES invite (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE SET NULL
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
        $this->addSql(<<<'SQL'
            ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image ADD CONSTRAINT FK_F6275988FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_evenement DROP FOREIGN KEY FK_2635DDF15BA88BA0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE jour_evenement DROP FOREIGN KEY FK_19459FBDFD02F13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30F20A01F78
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP FOREIGN KEY FK_A2ADD30FFD02F13
        SQL);
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
            ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11FD02F13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image DROP FOREIGN KEY FK_F6275988FD02F13
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE etape_evenement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evenement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE invite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE jour_evenement
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel_invite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE panel_conferencier
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE participant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE programme_image
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
    }
}
