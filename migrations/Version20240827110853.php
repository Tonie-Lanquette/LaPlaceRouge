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
        $this->addSql("INSERT INTO `categories` (`id`, `name`) VALUES
            (1, 'Entrée'),
            (2, 'Plat'),
            (3, 'Dessert')");
        $this->addSql("INSERT INTO `table` (`id`, `number`, `capacity`) VALUES
            (1, 1, '4'),
            (2, 2, '4'),
            (3, 3, '4'),
            (4, 4, '4'),
            (5, 5, '4'),
            (6, 6, '4'),
            (7, 7, '4'),
            (8, 8, '4'),
            (9, 9, '4'),
            (10, 10, '4'),
            (11, 11, '4'),
            (12, 12, '4'),
            (13, 13, '4'),
            (14, 14, '4'),
            (15, 15, '4'),
            (16, 16, '4'),
            (17, 17, '4'),
            (18, 18, '4'),
            (19, 19, '4'),
            (20, 20, '4'),
            (21, 21, '2'),
            (22, 22, '2'),
            (23, 23, '2'),
            (24, 24, '2'),
            (25, 25, '2'),
            (26, 26, '2'),
            (27, 27, '2'),
            (28, 28, '2'),
            (29, 29, '2'),
            (30, 30, '2'),
            (31, 31, '2'),
            (32, 32, '2'),
            (33, 33, '2'),
            (34, 34, '2'),
            (35, 35, '2'),
            (36, 36, '2'),
            (37, 37, '2'),
            (38, 38, '2'),
            (39, 39, '2'),
            (40, 40, '2');");
        $this->addSql("INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
            (1, 'email.admin@email.com', '[\"ROLE_ADMIN\"]', '$2y$13\$O863QWcpuncsokExainVGuMWixEdQIbRPS2BMdn7mg2VzbbJ50zZi', 'admin', 'email');");
    }

    public function down(Schema $schema): void {}
}
