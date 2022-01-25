<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125131415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumno ADD alumno_asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE alumno ADD CONSTRAINT FK_1435D52D366313DE FOREIGN KEY (alumno_asignatura_id) REFERENCES alumno_asignatura (id)');
        $this->addSql('CREATE INDEX IDX_1435D52D366313DE ON alumno (alumno_asignatura_id)');
        $this->addSql('ALTER TABLE alumno_asignatura DROP FOREIGN KEY FK_996F1A277BEFDD3E');
        $this->addSql('ALTER TABLE alumno_asignatura DROP FOREIGN KEY FK_996F1A277C1D59C9');
        $this->addSql('DROP INDEX IDX_996F1A277BEFDD3E ON alumno_asignatura');
        $this->addSql('DROP INDEX IDX_996F1A277C1D59C9 ON alumno_asignatura');
        $this->addSql('ALTER TABLE alumno_asignatura DROP id_alumno_id, DROP id_asignatura_id');
        $this->addSql('ALTER TABLE asignatura ADD alumno_asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE asignatura ADD CONSTRAINT FK_9243D6CE366313DE FOREIGN KEY (alumno_asignatura_id) REFERENCES alumno_asignatura (id)');
        $this->addSql('CREATE INDEX IDX_9243D6CE366313DE ON asignatura (alumno_asignatura_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumno DROP FOREIGN KEY FK_1435D52D366313DE');
        $this->addSql('DROP INDEX IDX_1435D52D366313DE ON alumno');
        $this->addSql('ALTER TABLE alumno DROP alumno_asignatura_id');
        $this->addSql('ALTER TABLE alumno_asignatura ADD id_alumno_id INT NOT NULL, ADD id_asignatura_id INT NOT NULL');
        $this->addSql('ALTER TABLE alumno_asignatura ADD CONSTRAINT FK_996F1A277BEFDD3E FOREIGN KEY (id_asignatura_id) REFERENCES asignatura (id)');
        $this->addSql('ALTER TABLE alumno_asignatura ADD CONSTRAINT FK_996F1A277C1D59C9 FOREIGN KEY (id_alumno_id) REFERENCES alumno (id)');
        $this->addSql('CREATE INDEX IDX_996F1A277BEFDD3E ON alumno_asignatura (id_asignatura_id)');
        $this->addSql('CREATE INDEX IDX_996F1A277C1D59C9 ON alumno_asignatura (id_alumno_id)');
        $this->addSql('ALTER TABLE asignatura DROP FOREIGN KEY FK_9243D6CE366313DE');
        $this->addSql('DROP INDEX IDX_9243D6CE366313DE ON asignatura');
        $this->addSql('ALTER TABLE asignatura DROP alumno_asignatura_id');
    }
}
