<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250325104232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_outil (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE outil (id INT AUTO_INCREMENT NOT NULL, souscategorie_outil_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, pdf VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_22627A3EBDFBEFD (souscategorie_outil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souscategorie_outil (id INT AUTO_INCREMENT NOT NULL, categorie_outil_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_765933D565FDDEA (categorie_outil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE outil ADD CONSTRAINT FK_22627A3EBDFBEFD FOREIGN KEY (souscategorie_outil_id) REFERENCES souscategorie_outil (id)');
        $this->addSql('ALTER TABLE souscategorie_outil ADD CONSTRAINT FK_765933D565FDDEA FOREIGN KEY (categorie_outil_id) REFERENCES categorie_outil (id)');
        $this->addSql('ALTER TABLE hopital CHANGE image image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE outil DROP FOREIGN KEY FK_22627A3EBDFBEFD');
        $this->addSql('ALTER TABLE souscategorie_outil DROP FOREIGN KEY FK_765933D565FDDEA');
        $this->addSql('DROP TABLE categorie_outil');
        $this->addSql('DROP TABLE outil');
        $this->addSql('DROP TABLE souscategorie_outil');
        $this->addSql('ALTER TABLE hopital CHANGE image image VARCHAR(255) DEFAULT NULL');
    }
}
