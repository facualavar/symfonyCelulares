<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130032745 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, nombre LONGTEXT NOT NULL, descripcion VARCHAR(255) NOT NULL, id_categoria INT NOT NULL, id_sub_categoria INT DEFAULT NULL, id_sub_sub_categoria INT DEFAULT NULL, id_marca INT NOT NULL, id_genero INT NOT NULL, id_origen INT NOT NULL, usado TINYINT(1) NOT NULL, oferta TINYINT(1) DEFAULT NULL, novedad TINYINT(1) DEFAULT NULL, destacado TINYINT(1) DEFAULT NULL, alto INT NOT NULL, ancho INT NOT NULL, largo INT NOT NULL, peso INT NOT NULL, habilitado TINYINT(1) NOT NULL, descuento INT DEFAULT NULL, precio INT NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE producto');
    }
}
