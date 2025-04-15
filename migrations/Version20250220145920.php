<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220145920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE souscategorie_recommand ADD categorie_recommand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE souscategorie_recommand ADD CONSTRAINT FK_9D706E2B3B4FA510 FOREIGN KEY (categorie_recommand_id) REFERENCES categorie_recommand (id)');
        $this->addSql('CREATE INDEX IDX_9D706E2B3B4FA510 ON souscategorie_recommand (categorie_recommand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE souscategorie_recommand DROP FOREIGN KEY FK_9D706E2B3B4FA510');
        $this->addSql('DROP INDEX IDX_9D706E2B3B4FA510 ON souscategorie_recommand');
        $this->addSql('ALTER TABLE souscategorie_recommand DROP categorie_recommand_id');
    }
}
