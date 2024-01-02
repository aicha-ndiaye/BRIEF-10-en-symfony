<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230172856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidature (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E33BD3B867B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, candidature_id INT NOT NULL, nom_formation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, lieu_formation VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, INDEX IDX_404021BFB6121583 (candidature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, nom_role VARCHAR(255) NOT NULL, INDEX IDX_B63E2EC767B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B867B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFB6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id)');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC767B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD competences VARCHAR(255) DEFAULT NULL, ADD motivation VARCHAR(255) DEFAULT NULL, ADD role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B867B3B43D');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFB6121583');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC767B3B43D');
        $this->addSql('DROP TABLE candidature');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE roles');
        $this->addSql('ALTER TABLE users DROP nom, DROP prenom, DROP email, DROP password, DROP competences, DROP motivation, DROP role');
    }
}
