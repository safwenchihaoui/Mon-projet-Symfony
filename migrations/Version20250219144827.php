<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219144827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation ADD sous_categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A28365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_C7782A28365BF48 ON recommandation (sous_categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A28365BF48');
        $this->addSql('DROP INDEX IDX_C7782A28365BF48 ON recommandation');
        $this->addSql('ALTER TABLE recommandation DROP sous_categorie_id');
    }
}
