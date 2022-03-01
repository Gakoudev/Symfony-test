<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220301114951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD invoicenumber INT NOT NULL, ADD customerid INT NOT NULL, DROP invoice_number, DROP customer_id, CHANGE invoice_date invoicedate DATE NOT NULL');
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D693429ECEE2');
        $this->addSql('DROP INDEX IDX_D3D1D693429ECEE2 ON invoice_line');
        $this->addSql('ALTER TABLE invoice_line CHANGE invoice_id_id invoiceid_id INT NOT NULL, CHANGE total_vat totalvat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D69320A48C29 FOREIGN KEY (invoiceid_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_D3D1D69320A48C29 ON invoice_line (invoiceid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD invoice_number INT NOT NULL, ADD customer_id INT NOT NULL, DROP invoicenumber, DROP customerid, CHANGE invoicedate invoice_date DATE NOT NULL');
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D69320A48C29');
        $this->addSql('DROP INDEX IDX_D3D1D69320A48C29 ON invoice_line');
        $this->addSql('ALTER TABLE invoice_line CHANGE invoiceid_id invoice_id_id INT NOT NULL, CHANGE totalvat total_vat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D693429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
        $this->addSql('CREATE INDEX IDX_D3D1D693429ECEE2 ON invoice_line (invoice_id_id)');
    }
}
