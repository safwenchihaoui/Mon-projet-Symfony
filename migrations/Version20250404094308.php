<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250404094308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sousmission DROP FOREIGN KEY FK_B94BE74871F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP INDEX IDX_B94BE74871F7E88B ON sousmission');
        $this->addSql('ALTER TABLE sousmission CHANGE event_id evennement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sousmission ADD CONSTRAINT FK_B94BE748DCDFA082 FOREIGN KEY (evennement_id) REFERENCES evennement (id)');
        $this->addSql('CREATE INDEX IDX_B94BE748DCDFA082 ON sousmission (evennement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sousmission DROP FOREIGN KEY FK_B94BE748DCDFA082');
        $this->addSql('DROP INDEX IDX_B94BE748DCDFA082 ON sousmission');
        $this->addSql('ALTER TABLE sousmission CHANGE evennement_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sousmission ADD CONSTRAINT FK_B94BE74871F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B94BE74871F7E88B ON sousmission (event_id)');
    }
}
