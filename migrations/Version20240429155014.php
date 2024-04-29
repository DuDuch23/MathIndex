<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429155014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise (id INT AUTO_INCREMENT NOT NULL, course_id_id INT DEFAULT NULL, classroom_id_id INT DEFAULT NULL, thematic_id_id INT DEFAULT NULL, origin_id_id INT DEFAULT NULL, exercice_file_id INT DEFAULT NULL, correction_file_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, chapter VARCHAR(255) NOT NULL, keywords VARCHAR(255) NOT NULL, difficulty INT NOT NULL, duration DOUBLE PRECISION NOT NULL, origin_name VARCHAR(255) NOT NULL, origin_information VARCHAR(255) NOT NULL, proposed_by_type VARCHAR(255) NOT NULL, proposed_by_first_name VARCHAR(255) NOT NULL, proposed_by_last_name VARCHAR(255) NOT NULL, INDEX IDX_AEDAD51C96EF99BF (course_id_id), INDEX IDX_AEDAD51C13BB01DE (classroom_id_id), INDEX IDX_AEDAD51CFF174F9A (thematic_id_id), INDEX IDX_AEDAD51CC23E42B3 (origin_id_id), UNIQUE INDEX UNIQ_AEDAD51C6E700FC1 (exercice_file_id), UNIQUE INDEX UNIQ_AEDAD51CA85344B2 (correction_file_id), INDEX IDX_AEDAD51CB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercise_skill (exercise_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_7B0B13B5E934951A (exercise_id), INDEX IDX_7B0B13B55585C142 (skill_id), PRIMARY KEY(exercise_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', original_name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE origin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, course_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5E3DE47796EF99BF (course_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thematic (id INT AUTO_INCREMENT NOT NULL, course_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7C1CDF7296EF99BF (course_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C96EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C13BB01DE FOREIGN KEY (classroom_id_id) REFERENCES classroom (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CFF174F9A FOREIGN KEY (thematic_id_id) REFERENCES thematic (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CC23E42B3 FOREIGN KEY (origin_id_id) REFERENCES origin (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C6E700FC1 FOREIGN KEY (exercice_file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CA85344B2 FOREIGN KEY (correction_file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE exercise_skill ADD CONSTRAINT FK_7B0B13B5E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id)');
        $this->addSql('ALTER TABLE exercise_skill ADD CONSTRAINT FK_7B0B13B55585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47796EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF7296EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C96EF99BF');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C13BB01DE');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CFF174F9A');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CC23E42B3');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C6E700FC1');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CA85344B2');
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51CB03A8386');
        $this->addSql('ALTER TABLE exercise_skill DROP FOREIGN KEY FK_7B0B13B5E934951A');
        $this->addSql('ALTER TABLE exercise_skill DROP FOREIGN KEY FK_7B0B13B55585C142');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE47796EF99BF');
        $this->addSql('ALTER TABLE thematic DROP FOREIGN KEY FK_7C1CDF7296EF99BF');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_skill');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE thematic');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
