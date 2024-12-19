<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218215102 extends AbstractMigration
{
  public function getDescription(): string
  {
    return '';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE media CHANGE staff staff LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE cast cast LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    $this->addSql('ALTER TABLE user ADD reset_password_token VARCHAR(255) NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs
    $this->addSql('ALTER TABLE user DROP reset_password_token, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:json)\'');
    $this->addSql('ALTER TABLE media CHANGE staff staff LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:json)\', CHANGE cast cast LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin` COMMENT \'(DC2Type:json)\'');
  }
}
