<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260313123526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inventarios (id INT AUTO_INCREMENT NOT NULL, personaje_id INT NOT NULL, objeto_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_D6B3D0D6121EFAFB (personaje_id), INDEX IDX_D6B3D0D676F5CD27 (objeto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oferta_comercial (id INT AUTO_INCREMENT NOT NULL, vendedor_id INT NOT NULL, objeto_id INT NOT NULL, stock INT NOT NULL, precio_local INT NOT NULL, rebaja VARCHAR(100) DEFAULT NULL, INDEX IDX_1C13E6068361A8B8 (vendedor_id), INDEX IDX_1C13E60676F5CD27 (objeto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inventarios ADD CONSTRAINT FK_D6B3D0D6121EFAFB FOREIGN KEY (personaje_id) REFERENCES personajes (id)');
        $this->addSql('ALTER TABLE inventarios ADD CONSTRAINT FK_D6B3D0D676F5CD27 FOREIGN KEY (objeto_id) REFERENCES objetos (id)');
        $this->addSql('ALTER TABLE oferta_comercial ADD CONSTRAINT FK_1C13E6068361A8B8 FOREIGN KEY (vendedor_id) REFERENCES npcs (id)');
        $this->addSql('ALTER TABLE oferta_comercial ADD CONSTRAINT FK_1C13E60676F5CD27 FOREIGN KEY (objeto_id) REFERENCES objetos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inventarios DROP FOREIGN KEY FK_D6B3D0D6121EFAFB');
        $this->addSql('ALTER TABLE inventarios DROP FOREIGN KEY FK_D6B3D0D676F5CD27');
        $this->addSql('ALTER TABLE oferta_comercial DROP FOREIGN KEY FK_1C13E6068361A8B8');
        $this->addSql('ALTER TABLE oferta_comercial DROP FOREIGN KEY FK_1C13E60676F5CD27');
        $this->addSql('DROP TABLE inventarios');
        $this->addSql('DROP TABLE oferta_comercial');
    }
}
