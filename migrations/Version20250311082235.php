<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311082235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE docteur ADD hopital_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE docteur ADD CONSTRAINT FK_83A7A439CC0FBF92 FOREIGN KEY (hopital_id) REFERENCES hopital (id)');
        $this->addSql('CREATE INDEX IDX_83A7A439CC0FBF92 ON docteur (hopital_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE docteur DROP FOREIGN KEY FK_83A7A439CC0FBF92');
        $this->addSql('DROP INDEX IDX_83A7A439CC0FBF92 ON docteur');
        $this->addSql('ALTER TABLE docteur DROP hopital_id');
    }
}
