<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250220154030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recommandation (id INT AUTO_INCREMENT NOT NULL, souscategorie_recommand_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, pdf VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_C7782A28F9225BB9 (souscategorie_recommand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recommandation ADD CONSTRAINT FK_C7782A28F9225BB9 FOREIGN KEY (souscategorie_recommand_id) REFERENCES souscategorie_recommand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recommandation DROP FOREIGN KEY FK_C7782A28F9225BB9');
        $this->addSql('DROP TABLE recommandation');
    }
}
