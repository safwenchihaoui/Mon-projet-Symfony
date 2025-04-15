<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250221075637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement ADD categorie_event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evennement ADD CONSTRAINT FK_5C15C7744970A9E1 FOREIGN KEY (categorie_event_id) REFERENCES categorie_event (id)');
        $this->addSql('CREATE INDEX IDX_5C15C7744970A9E1 ON evennement (categorie_event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement DROP FOREIGN KEY FK_5C15C7744970A9E1');
        $this->addSql('DROP INDEX IDX_5C15C7744970A9E1 ON evennement');
        $this->addSql('ALTER TABLE evennement DROP categorie_event_id');
    }
}
