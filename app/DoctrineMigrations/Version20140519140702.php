<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140519140702 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE seats ADD zone_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE seats ADD CONSTRAINT FK_BFE257509F2C3FAB FOREIGN KEY (zone_id) REFERENCES zones (id)");
        $this->addSql("CREATE INDEX IDX_BFE257509F2C3FAB ON seats (zone_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE seats DROP FOREIGN KEY FK_BFE257509F2C3FAB");
        $this->addSql("DROP INDEX IDX_BFE257509F2C3FAB ON seats");
        $this->addSql("ALTER TABLE seats DROP zone_id");
    }
}
