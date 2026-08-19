<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260818230436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE classroom_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exercise_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE origin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE skill_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE thematic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE classroom (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE exercise (id INT NOT NULL, course_id_id INT DEFAULT NULL, classroom_id_id INT DEFAULT NULL, thematic_id_id INT DEFAULT NULL, origin_id_id INT DEFAULT NULL, exercice_file_id INT DEFAULT NULL, correction_file_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, chapter VARCHAR(255) NOT NULL, keywords VARCHAR(255) NOT NULL, difficulty INT NOT NULL, duration DOUBLE PRECISION NOT NULL, origin_name VARCHAR(255) NOT NULL, origin_information VARCHAR(255) NOT NULL, proposed_by_type VARCHAR(255) NOT NULL, proposed_by_first_name VARCHAR(255) NOT NULL, proposed_by_last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AEDAD51C96EF99BF ON exercise (course_id_id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C13BB01DE ON exercise (classroom_id_id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51CFF174F9A ON exercise (thematic_id_id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51CC23E42B3 ON exercise (origin_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEDAD51C6E700FC1 ON exercise (exercice_file_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AEDAD51CA85344B2 ON exercise (correction_file_id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51CB03A8386 ON exercise (created_by_id)');
        $this->addSql('CREATE TABLE exercise_skill (exercise_id INT NOT NULL, skill_id INT NOT NULL, PRIMARY KEY(exercise_id, skill_id))');
        $this->addSql('CREATE INDEX IDX_7B0B13B5E934951A ON exercise_skill (exercise_id)');
        $this->addSql('CREATE INDEX IDX_7B0B13B55585C142 ON exercise_skill (skill_id)');
        $this->addSql('CREATE TABLE file (id INT NOT NULL, name VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, original_name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, size INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN file.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE origin (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skill (id INT NOT NULL, course_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5E3DE47796EF99BF ON skill (course_id_id)');
        $this->addSql('CREATE TABLE thematic (id INT NOT NULL, course_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C1CDF7296EF99BF ON thematic (course_id_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 ON messenger_messages (queue_name, available_at, delivered_at, id)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C96EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C13BB01DE FOREIGN KEY (classroom_id_id) REFERENCES classroom (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CFF174F9A FOREIGN KEY (thematic_id_id) REFERENCES thematic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CC23E42B3 FOREIGN KEY (origin_id_id) REFERENCES origin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C6E700FC1 FOREIGN KEY (exercice_file_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CA85344B2 FOREIGN KEY (correction_file_id) REFERENCES file (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51CB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise_skill ADD CONSTRAINT FK_7B0B13B5E934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercise_skill ADD CONSTRAINT FK_7B0B13B55585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE47796EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE thematic ADD CONSTRAINT FK_7C1CDF7296EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE classroom_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exercise_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE origin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE skill_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE thematic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51C96EF99BF');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51C13BB01DE');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51CFF174F9A');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51CC23E42B3');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51C6E700FC1');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51CA85344B2');
        $this->addSql('ALTER TABLE exercise DROP CONSTRAINT FK_AEDAD51CB03A8386');
        $this->addSql('ALTER TABLE exercise_skill DROP CONSTRAINT FK_7B0B13B5E934951A');
        $this->addSql('ALTER TABLE exercise_skill DROP CONSTRAINT FK_7B0B13B55585C142');
        $this->addSql('ALTER TABLE skill DROP CONSTRAINT FK_5E3DE47796EF99BF');
        $this->addSql('ALTER TABLE thematic DROP CONSTRAINT FK_7C1CDF7296EF99BF');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE exercise');
        $this->addSql('DROP TABLE exercise_skill');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE thematic');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
