<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220130233834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anonces (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, create_post DATETIME NOT NULL, user_create VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_anonces (id INT AUTO_INCREMENT NOT NULL, anonces_id INT NOT NULL, user_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_AA5A7C72A4744E38 (anonces_id), INDEX IDX_AA5A7C72A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, create_count DATETIME NOT NULL, votes INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions_anonces ADD CONSTRAINT FK_AA5A7C72A4744E38 FOREIGN KEY (anonces_id) REFERENCES anonces (id)');
        $this->addSql('ALTER TABLE questions_anonces ADD CONSTRAINT FK_AA5A7C72A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions_anonces DROP FOREIGN KEY FK_AA5A7C72A4744E38');
        $this->addSql('ALTER TABLE questions_anonces DROP FOREIGN KEY FK_AA5A7C72A76ED395');
        $this->addSql('DROP TABLE anonces');
        $this->addSql('DROP TABLE questions_anonces');
        $this->addSql('DROP TABLE user');
    }
}
