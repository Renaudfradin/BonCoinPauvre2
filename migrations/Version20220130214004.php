<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130214004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions_anonces ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions_anonces ADD CONSTRAINT FK_AA5A7C72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AA5A7C72A76ED395 ON questions_anonces (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions_anonces DROP FOREIGN KEY FK_AA5A7C72A76ED395');
        $this->addSql('DROP INDEX IDX_AA5A7C72A76ED395 ON questions_anonces');
        $this->addSql('ALTER TABLE questions_anonces DROP user_id');
    }
}
