<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202044339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE producto ADD sub_categoria_id INT DEFAULT NULL, ADD sub_sub_categoria_id INT DEFAULT NULL, ADD pais_id INT DEFAULT NULL, ADD marca_id INT DEFAULT NULL, ADD genero_id INT DEFAULT NULL, DROP id_categoria, DROP id_sub_categoria, DROP id_sub_sub_categoria, DROP id_marca, DROP id_genero, DROP id_pais');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061524C5374C FOREIGN KEY (sub_categoria_id) REFERENCES sub_categoria (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB06158F0EB165 FOREIGN KEY (sub_sub_categoria_id) REFERENCES sub_sub_categoria (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615C604D5C6 FOREIGN KEY (pais_id) REFERENCES pais (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB061581EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615BCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id)');
        $this->addSql('CREATE INDEX IDX_A7BB061524C5374C ON producto (sub_categoria_id)');
        $this->addSql('CREATE INDEX IDX_A7BB06158F0EB165 ON producto (sub_sub_categoria_id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615C604D5C6 ON producto (pais_id)');
        $this->addSql('CREATE INDEX IDX_A7BB061581EF0041 ON producto (marca_id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615BCE7B795 ON producto (genero_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061524C5374C');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB06158F0EB165');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615C604D5C6');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB061581EF0041');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615BCE7B795');
        $this->addSql('DROP INDEX IDX_A7BB061524C5374C ON producto');
        $this->addSql('DROP INDEX IDX_A7BB06158F0EB165 ON producto');
        $this->addSql('DROP INDEX IDX_A7BB0615C604D5C6 ON producto');
        $this->addSql('DROP INDEX IDX_A7BB061581EF0041 ON producto');
        $this->addSql('DROP INDEX IDX_A7BB0615BCE7B795 ON producto');
        $this->addSql('ALTER TABLE producto ADD id_categoria INT NOT NULL, ADD id_sub_categoria INT DEFAULT NULL, ADD id_sub_sub_categoria INT DEFAULT NULL, ADD id_marca INT NOT NULL, ADD id_genero INT NOT NULL, ADD id_pais INT NOT NULL, DROP sub_categoria_id, DROP sub_sub_categoria_id, DROP pais_id, DROP marca_id, DROP genero_id');
    }
}
