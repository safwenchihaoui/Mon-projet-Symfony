<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219143115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evennement (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, INDEX IDX_5C15C774BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evennement ADD CONSTRAINT FK_5C15C774BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE evennemnt ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evennemnt ADD CONSTRAINT FK_B7512058BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_B7512058BCF5E72D ON evennemnt (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement DROP FOREIGN KEY FK_5C15C774BCF5E72D');
        $this->addSql('DROP TABLE evennement');
        $this->addSql('ALTER TABLE evennemnt DROP FOREIGN KEY FK_B7512058BCF5E72D');
        $this->addSql('DROP INDEX IDX_B7512058BCF5E72D ON evennemnt');
        $this->addSql('ALTER TABLE evennemnt DROP categorie_id');
    }
}
