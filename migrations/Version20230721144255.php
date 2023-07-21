<?php

// phpcs:ignoreFile

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230721144255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE sonata_page_block (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, page_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, settings LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', enabled TINYINT(1) DEFAULT NULL, position INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D319A22B727ACA70 (parent_id), INDEX IDX_D319A22BC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sonata_page_page (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, route_name VARCHAR(255) NOT NULL, page_alias VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, decorate TINYINT(1) NOT NULL, edited TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, slug LONGTEXT DEFAULT NULL, url LONGTEXT DEFAULT NULL, custom_url LONGTEXT DEFAULT NULL, request_method VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, meta_keyword VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, javascript LONGTEXT DEFAULT NULL, stylesheet LONGTEXT DEFAULT NULL, raw_headers LONGTEXT DEFAULT NULL, template VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_134E8350F6BD1646 (site_id), INDEX IDX_134E8350727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sonata_page_site (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, relative_path VARCHAR(255) DEFAULT NULL, host VARCHAR(255) NOT NULL, enabled_from DATETIME DEFAULT NULL, enabled_to DATETIME DEFAULT NULL, is_default TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, locale VARCHAR(7) DEFAULT NULL, title VARCHAR(64) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sonata_page_snapshot (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, page_id INT DEFAULT NULL, route_name VARCHAR(255) NOT NULL, page_alias VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, decorate TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, url LONGTEXT DEFAULT NULL, parent_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', publication_date_start DATETIME DEFAULT NULL, publication_date_end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6FA38D70F6BD1646 (site_id), INDEX IDX_6FA38D70C4663E4 (page_id), INDEX idx_snapshot_dates_enabled (publication_date_start, publication_date_end, enabled), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sonata_page_block ADD CONSTRAINT FK_D319A22B727ACA70 FOREIGN KEY (parent_id) REFERENCES sonata_page_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sonata_page_block ADD CONSTRAINT FK_D319A22BC4663E4 FOREIGN KEY (page_id) REFERENCES sonata_page_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sonata_page_page ADD CONSTRAINT FK_134E8350F6BD1646 FOREIGN KEY (site_id) REFERENCES sonata_page_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sonata_page_page ADD CONSTRAINT FK_134E8350727ACA70 FOREIGN KEY (parent_id) REFERENCES sonata_page_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sonata_page_snapshot ADD CONSTRAINT FK_6FA38D70F6BD1646 FOREIGN KEY (site_id) REFERENCES sonata_page_site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sonata_page_snapshot ADD CONSTRAINT FK_6FA38D70C4663E4 FOREIGN KEY (page_id) REFERENCES sonata_page_page (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sonata_page_block DROP FOREIGN KEY FK_D319A22B727ACA70');
        $this->addSql('ALTER TABLE sonata_page_block DROP FOREIGN KEY FK_D319A22BC4663E4');
        $this->addSql('ALTER TABLE sonata_page_page DROP FOREIGN KEY FK_134E8350F6BD1646');
        $this->addSql('ALTER TABLE sonata_page_page DROP FOREIGN KEY FK_134E8350727ACA70');
        $this->addSql('ALTER TABLE sonata_page_snapshot DROP FOREIGN KEY FK_6FA38D70F6BD1646');
        $this->addSql('ALTER TABLE sonata_page_snapshot DROP FOREIGN KEY FK_6FA38D70C4663E4');
        $this->addSql('DROP TABLE sonata_page_block');
        $this->addSql('DROP TABLE sonata_page_page');
        $this->addSql('DROP TABLE sonata_page_site');
        $this->addSql('DROP TABLE sonata_page_snapshot');
    }
}
