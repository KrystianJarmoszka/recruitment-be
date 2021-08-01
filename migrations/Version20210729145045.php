<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729145045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD propety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8F5694F53 FOREIGN KEY (propety_id) REFERENCES property (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8F5694F53 ON job (propety_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8F5694F53');
        $this->addSql('DROP INDEX IDX_FBD8E0F8F5694F53 ON job');
        $this->addSql('ALTER TABLE job DROP propety_id');
    }
}
