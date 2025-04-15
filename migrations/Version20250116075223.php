<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116075223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement ADD categorie_id INT DEFAULT NULL, DROP categorie');
        $this->addSql('ALTER TABLE evennement ADD CONSTRAINT FK_5C15C774BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_5C15C774BCF5E72D ON evennement (categorie_id)');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP nom, DROP prenom, DROP email, DROP description');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_ID ON user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement DROP FOREIGN KEY FK_5C15C774BCF5E72D');
        $this->addSql('DROP INDEX IDX_5C15C774BCF5E72D ON evennement');
        $this->addSql('ALTER TABLE evennement ADD categorie VARCHAR(50) NOT NULL, DROP categorie_id');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_ID ON user');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL, ADD email VARCHAR(150) NOT NULL, ADD description VARCHAR(50) NOT NULL, DROP roles, DROP password');
    }
}
