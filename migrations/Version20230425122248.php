<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425122248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, lu_am VARCHAR(20) NOT NULL, lu_pm VARCHAR(20) NOT NULL, ma_am VARCHAR(20) NOT NULL, ma_pm VARCHAR(20) NOT NULL, me_am VARCHAR(20) NOT NULL, me_pm VARCHAR(20) NOT NULL, je_am VARCHAR(20) NOT NULL, je_pm VARCHAR(20) NOT NULL, ve_am VARCHAR(20) NOT NULL, ve_pm VARCHAR(20) NOT NULL, sa_am VARCHAR(20) NOT NULL, sa_pm VARCHAR(20) NOT NULL, di_am VARCHAR(20) NOT NULL, di_pm VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE horaires');
    }
}
