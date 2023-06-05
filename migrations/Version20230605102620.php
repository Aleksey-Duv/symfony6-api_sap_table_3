<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605102620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE t001 (id INT AUTO_INCREMENT NOT NULL, bukrs VARCHAR(4) NOT NULL, butxt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zinmm_sof_lot_h (lot_id INT AUTO_INCREMENT NOT NULL, konkurs_id INT NOT NULL, lot_nr VARCHAR(30) NOT NULL, lot_name VARCHAR(132) NOT NULL, INDEX IDX_C2D2F2583DF04F9F (konkurs_id), PRIMARY KEY(lot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ztinmm_tk_h (konkurs_id INT AUTO_INCREMENT NOT NULL, bukrs_id_id INT DEFAULT NULL, konkurs_nr VARCHAR(40) NOT NULL, konkurs_name VARCHAR(255) NOT NULL, INDEX IDX_87D4C94FDA224083 (bukrs_id_id), PRIMARY KEY(konkurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zinmm_sof_lot_h ADD CONSTRAINT FK_C2D2F2583DF04F9F FOREIGN KEY (konkurs_id) REFERENCES ztinmm_tk_h (konkurs_id)');
        $this->addSql('ALTER TABLE ztinmm_tk_h ADD CONSTRAINT FK_87D4C94FDA224083 FOREIGN KEY (bukrs_id_id) REFERENCES t001 (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zinmm_sof_lot_h DROP FOREIGN KEY FK_C2D2F2583DF04F9F');
        $this->addSql('ALTER TABLE ztinmm_tk_h DROP FOREIGN KEY FK_87D4C94FDA224083');
        $this->addSql('DROP TABLE t001');
        $this->addSql('DROP TABLE zinmm_sof_lot_h');
        $this->addSql('DROP TABLE ztinmm_tk_h');
    }
}
