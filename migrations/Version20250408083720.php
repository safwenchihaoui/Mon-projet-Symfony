<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408083720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB140E8F9E4C2');
        $this->addSql('DROP INDEX IDX_55AB140E8F9E4C2 ON auteur');
        $this->addSql('ALTER TABLE auteur DROP sousmission_id');
        $this->addSql('ALTER TABLE sousmission CHANGE typemission type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur ADD sousmission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB140E8F9E4C2 FOREIGN KEY (sousmission_id) REFERENCES sousmission (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_55AB140E8F9E4C2 ON auteur (sousmission_id)');
        $this->addSql('ALTER TABLE sousmission CHANGE type typemission VARCHAR(255) NOT NULL');
    }
}
