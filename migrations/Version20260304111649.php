<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260304111649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capitulos (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, titulo VARCHAR(255) NOT NULL, resumen LONGTEXT DEFAULT NULL, resumen_completo LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clase (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, lvl1 VARCHAR(255) DEFAULT NULL, lvl2 VARCHAR(255) DEFAULT NULL, lvl3 VARCHAR(255) DEFAULT NULL, lvl4 VARCHAR(255) DEFAULT NULL, lvl5 VARCHAR(255) DEFAULT NULL, lvl6 VARCHAR(255) DEFAULT NULL, lvl7 VARCHAR(255) DEFAULT NULL, lvl8 VARCHAR(255) DEFAULT NULL, lvl9 VARCHAR(255) DEFAULT NULL, lvl10 VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jugador (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, edad INT NOT NULL, lugar VARCHAR(255) NOT NULL, master TINYINT(1) NOT NULL, apellido VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lugares (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, ciudad TINYINT(1) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, mapa VARCHAR(255) DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE npc (id INT AUTO_INCREMENT NOT NULL, lugar_id INT NOT NULL, raza_id INT NOT NULL, clase_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, vivo TINYINT(1) NOT NULL, amistoso TINYINT(1) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, comerciante TINYINT(1) NOT NULL, edad INT DEFAULT NULL, genero VARCHAR(1) NOT NULL, imagen VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, INDEX IDX_468C762CB5A3803B (lugar_id), INDEX IDX_468C762C8CCBB6A9 (raza_id), INDEX IDX_468C762C9F720353 (clase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personaje (id INT AUTO_INCREMENT NOT NULL, jugador_id INT NOT NULL, clase_id INT NOT NULL, raza_id INT NOT NULL, lugar_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, edad INT DEFAULT NULL, vivo TINYINT(1) NOT NULL, genero VARCHAR(1) NOT NULL, stats_pj INT DEFAULT NULL, imagen VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, INDEX IDX_53A41088B8A54D43 (jugador_id), INDEX IDX_53A410889F720353 (clase_id), INDEX IDX_53A410888CCBB6A9 (raza_id), INDEX IDX_53A41088B5A3803B (lugar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raza (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, origen VARCHAR(255) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CB5A3803B FOREIGN KEY (lugar_id) REFERENCES lugares (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C8CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762C9F720353 FOREIGN KEY (clase_id) REFERENCES clase (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088B8A54D43 FOREIGN KEY (jugador_id) REFERENCES jugador (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410889F720353 FOREIGN KEY (clase_id) REFERENCES clase (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410888CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id)');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A41088B5A3803B FOREIGN KEY (lugar_id) REFERENCES lugares (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CB5A3803B');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C8CCBB6A9');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762C9F720353');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088B8A54D43');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410889F720353');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A410888CCBB6A9');
        $this->addSql('ALTER TABLE personaje DROP FOREIGN KEY FK_53A41088B5A3803B');
        $this->addSql('DROP TABLE capitulos');
        $this->addSql('DROP TABLE clase');
        $this->addSql('DROP TABLE jugador');
        $this->addSql('DROP TABLE lugares');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE personaje');
        $this->addSql('DROP TABLE raza');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
