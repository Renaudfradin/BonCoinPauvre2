<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131113220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anonces ADD CONSTRAINT FK_D9DF5CB431388D4 FOREIGN KEY (user_anonces_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D9DF5CB431388D4 ON anonces (user_anonces_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anonces DROP FOREIGN KEY FK_D9DF5CB431388D4');
        $this->addSql('DROP INDEX IDX_D9DF5CB431388D4 ON anonces');
    }
}
