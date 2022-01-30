<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130213243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questions_anonces (id INT AUTO_INCREMENT NOT NULL, anonces_id INT NOT NULL, content VARCHAR(255) NOT NULL, user_questions VARCHAR(255) NOT NULL, anonces_questions VARCHAR(255) NOT NULL, INDEX IDX_AA5A7C72A4744E38 (anonces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions_anonces ADD CONSTRAINT FK_AA5A7C72A4744E38 FOREIGN KEY (anonces_id) REFERENCES anonces (id)');
        $this->addSql('ALTER TABLE anonces ADD user_create VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD votes INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE questions_anonces');
        $this->addSql('ALTER TABLE anonces DROP user_create');
        $this->addSql('ALTER TABLE user DROP votes');
    }
}
