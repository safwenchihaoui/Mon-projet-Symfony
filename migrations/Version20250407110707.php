<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407110707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB14092F3E75D');
        $this->addSql('DROP INDEX IDX_55AB14092F3E75D ON auteur');
        $this->addSql('ALTER TABLE auteur DROP sousmissions_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur ADD sousmissions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB14092F3E75D FOREIGN KEY (sousmissions_id) REFERENCES sousmission (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_55AB14092F3E75D ON auteur (sousmissions_id)');
    }
}
