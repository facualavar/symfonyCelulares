<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716024755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, descripcion VARCHAR(255) NOT NULL, categoria VARCHAR(20) NOT NULL, marca VARCHAR(20) NOT NULL, caracteristicas VARCHAR(255) NOT NULL, img VARCHAR(50) NOT NULL, img2 VARCHAR(50) DEFAULT NULL, img3 VARCHAR(50) DEFAULT NULL, precio INT NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombres VARCHAR(50) NOT NULL, apellido VARCHAR(20) NOT NULL, usuario VARCHAR(30) NOT NULL, password VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, perfil VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE usuario');
    }
}
