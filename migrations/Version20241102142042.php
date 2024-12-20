<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241102142042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP media_type');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD media_type VARCHAR(255) NOT NULL');
    }
}
