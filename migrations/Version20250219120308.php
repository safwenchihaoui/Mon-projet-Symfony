<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219120308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement ADD relation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD sous_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7B365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES recommandation (id)');
        $this->addSql('CREATE INDEX IDX_52743D7B365BF48 ON sous_categorie (sous_categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evennement DROP relation');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7B365BF48');
        $this->addSql('DROP INDEX IDX_52743D7B365BF48 ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie DROP sous_categorie_id');
    }
}
