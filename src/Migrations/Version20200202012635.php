<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202012635 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_categoria ADD categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sub_categoria ADD CONSTRAINT FK_5C1D54933397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_5C1D54933397707A ON sub_categoria (categoria_id)');
        $this->addSql('ALTER TABLE sub_sub_categoria ADD sub_categoria_id INT DEFAULT NULL, ADD categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sub_sub_categoria ADD CONSTRAINT FK_93B0934D24C5374C FOREIGN KEY (sub_categoria_id) REFERENCES sub_categoria (id)');
        $this->addSql('ALTER TABLE sub_sub_categoria ADD CONSTRAINT FK_93B0934D3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_93B0934D24C5374C ON sub_sub_categoria (sub_categoria_id)');
        $this->addSql('CREATE INDEX IDX_93B0934D3397707A ON sub_sub_categoria (categoria_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_categoria DROP FOREIGN KEY FK_5C1D54933397707A');
        $this->addSql('DROP INDEX IDX_5C1D54933397707A ON sub_categoria');
        $this->addSql('ALTER TABLE sub_categoria DROP categoria_id');
        $this->addSql('ALTER TABLE sub_sub_categoria DROP FOREIGN KEY FK_93B0934D24C5374C');
        $this->addSql('ALTER TABLE sub_sub_categoria DROP FOREIGN KEY FK_93B0934D3397707A');
        $this->addSql('DROP INDEX IDX_93B0934D24C5374C ON sub_sub_categoria');
        $this->addSql('DROP INDEX IDX_93B0934D3397707A ON sub_sub_categoria');
        $this->addSql('ALTER TABLE sub_sub_categoria DROP sub_categoria_id, DROP categoria_id');
    }
}
