<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250616204650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE etape_evenement (id UUID NOT NULL, jour_evenement_id UUID NOT NULL, titre VARCHAR(255) NOT NULL, heure_debut TIME(0) WITHOUT TIME ZONE NOT NULL, heure_fin TIME(0) WITHOUT TIME ZONE NOT NULL, activites TEXT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_2635DDF15BA88BA0 ON etape_evenement (jour_evenement_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN etape_evenement.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN etape_evenement.jour_evenement_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evenement (id UUID NOT NULL, titre VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, date_creation DATE NOT NULL, actif BOOLEAN NOT NULL, lien_video TEXT DEFAULT NULL, description TEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN evenement.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN evenement.date_debut IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN evenement.date_fin IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN evenement.date_creation IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE invite (id UUID NOT NULL, poste VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, biographie TEXT DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invite.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invite.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE jour_evenement (id UUID NOT NULL, evenement_id UUID NOT NULL, date DATE NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_19459FBDFD02F13 ON jour_evenement (evenement_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN jour_evenement.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN jour_evenement.evenement_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel (id UUID NOT NULL, moderateur_id UUID DEFAULT NULL, evenement_id UUID DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A2ADD30F20A01F78 ON panel (moderateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A2ADD30FFD02F13 ON panel (evenement_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel.moderateur_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel.evenement_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_invite (panel_id UUID NOT NULL, invite_id UUID NOT NULL, PRIMARY KEY(panel_id, invite_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_33E663956F6FCB26 ON panel_invite (panel_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_33E66395EA417747 ON panel_invite (invite_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel_invite.panel_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel_invite.invite_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE panel_conferencier (panel_id UUID NOT NULL, invite_id UUID NOT NULL, PRIMARY KEY(panel_id, invite_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_93FCB40F6F6FCB26 ON panel_conferencier (panel_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_93FCB40FEA417747 ON panel_conferencier (invite_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel_conferencier.panel_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN panel_conferencier.invite_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE participant (id UUID NOT NULL, evenement_id UUID NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D79F6B11FD02F13 ON participant (evenement_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN participant.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN participant.evenement_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE programme_image (id UUID NOT NULL, evenement_id UUID NOT NULL, image VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F6275988FD02F13 ON programme_image (evenement_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN programme_image.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN programme_image.evenement_id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN programme_image.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON utilisateur (email)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN utilisateur.id IS '(DC2Type:ulid)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_evenement ADD CONSTRAINT FK_2635DDF15BA88BA0 FOREIGN KEY (jour_evenement_id) REFERENCES jour_evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE jour_evenement ADD CONSTRAINT FK_19459FBDFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30F20A01F78 FOREIGN KEY (moderateur_id) REFERENCES invite (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel ADD CONSTRAINT FK_A2ADD30FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E663956F6FCB26 FOREIGN KEY (panel_id) REFERENCES panel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite ADD CONSTRAINT FK_33E66395EA417747 FOREIGN KEY (invite_id) REFERENCES invite (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier ADD CONSTRAINT FK_93FCB40F6F6FCB26 FOREIGN KEY (panel_id) REFERENCES panel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier ADD CONSTRAINT FK_93FCB40FEA417747 FOREIGN KEY (invite_id) REFERENCES invite (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image ADD CONSTRAINT FK_F6275988FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE etape_evenement DROP CONSTRAINT FK_2635DDF15BA88BA0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE jour_evenement DROP CONSTRAINT FK_19459FBDFD02F13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP CONSTRAINT FK_A2ADD30F20A01F78
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel DROP CONSTRAINT FK_A2ADD30FFD02F13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP CONSTRAINT FK_33E663956F6FCB26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_invite DROP CONSTRAINT FK_33E66395EA417747
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier DROP CONSTRAINT FK_93FCB40F6F6FCB26
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE panel_conferencier DROP CONSTRAINT FK_93FCB40FEA417747
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE participant DROP CONSTRAINT FK_D79F6B11FD02F13
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE programme_image DROP CONSTRAINT FK_F6275988FD02F13
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
