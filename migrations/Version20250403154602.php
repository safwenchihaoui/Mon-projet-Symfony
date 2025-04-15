<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250403154602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, sousmission_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_55AB140E8F9E4C2 (sousmission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sousmission (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, fichier VARCHAR(255) NOT NULL, INDEX IDX_B94BE74871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur ADD CONSTRAINT FK_55AB140E8F9E4C2 FOREIGN KEY (sousmission_id) REFERENCES sousmission (id)');
        $this->addSql('ALTER TABLE sousmission ADD CONSTRAINT FK_B94BE74871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE outil CHANGE description description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur DROP FOREIGN KEY FK_55AB140E8F9E4C2');
        $this->addSql('ALTER TABLE sousmission DROP FOREIGN KEY FK_B94BE74871F7E88B');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE sousmission');
        $this->addSql('ALTER TABLE outil CHANGE description description TEXT NOT NULL');
    }
}
