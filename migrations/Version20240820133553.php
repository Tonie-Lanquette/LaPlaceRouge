<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820133553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_dishies (menu_id INT NOT NULL, dishies_id INT NOT NULL, INDEX IDX_93D5FE9CCCD7E912 (menu_id), INDEX IDX_93D5FE9CCF63DA8D (dishies_id), PRIMARY KEY(menu_id, dishies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_dishies ADD CONSTRAINT FK_93D5FE9CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_dishies ADD CONSTRAINT FK_93D5FE9CCF63DA8D FOREIGN KEY (dishies_id) REFERENCES dishies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishies_menu DROP FOREIGN KEY FK_FC433EAACCD7E912');
        $this->addSql('ALTER TABLE dishies_menu DROP FOREIGN KEY FK_FC433EAACF63DA8D');
        $this->addSql('DROP TABLE dishies_menu');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishies_menu (dishies_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_FC433EAACF63DA8D (dishies_id), INDEX IDX_FC433EAACCD7E912 (menu_id), PRIMARY KEY(dishies_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dishies_menu ADD CONSTRAINT FK_FC433EAACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishies_menu ADD CONSTRAINT FK_FC433EAACF63DA8D FOREIGN KEY (dishies_id) REFERENCES dishies (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_dishies DROP FOREIGN KEY FK_93D5FE9CCCD7E912');
        $this->addSql('ALTER TABLE menu_dishies DROP FOREIGN KEY FK_93D5FE9CCF63DA8D');
        $this->addSql('DROP TABLE menu_dishies');
    }
}
