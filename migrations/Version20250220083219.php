<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220083219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evennement ADD CONSTRAINT FK_5C15C774BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_5C15C774BCF5E72D ON evennement (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement DROP FOREIGN KEY FK_5C15C774BCF5E72D');
        $this->addSql('DROP INDEX IDX_5C15C774BCF5E72D ON evennement');
        $this->addSql('ALTER TABLE evennement DROP categorie_id');
    }
}
