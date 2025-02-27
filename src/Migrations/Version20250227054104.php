<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250227054104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating user table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (
            id CHAR(36) NOT NULL PRIMARY KEY, 
            name VARCHAR(50) NOT NULL, 
            email VARCHAR(100) NOT NULL UNIQUE, 
            password VARCHAR(255) NOT NULL, 
            created_at DATETIME NOT NULL
        )');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
