<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140519141815 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, fullName VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, seat_id INT DEFAULT NULL, participant_id INT DEFAULT NULL, INDEX IDX_54469DF4C1DAFE35 (seat_id), INDEX IDX_54469DF49D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seats (id)");
        $this->addSql("ALTER TABLE tickets ADD CONSTRAINT FK_54469DF49D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF49D1C3019");
        $this->addSql("DROP TABLE participants");
        $this->addSql("DROP TABLE tickets");
    }
}
