<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $invoicedate;

    #[ORM\Column(type: 'integer')]
    private $invoicenumber;

    #[ORM\Column(type: 'integer')]
    private $customerid;

    #[ORM\OneToMany(mappedBy: 'invoice_id', targetEntity: InvoiceLine::class, orphanRemoval: true)]
    private $invoiceLines;

    public function __construct()
    {
        $this->invoiceLines = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->invoicenumber;
        ;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoicedate;
    }

    public function setInvoiceDate(\DateTimeInterface $invoicedate): self
    {
        $this->invoicedate = $invoicedate;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoicenumber;
    }

    public function setInvoiceNumber(int $invoicenumber): self
    {
        $this->invoicenumber = $invoicenumber;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerid;
    }

    public function setCustomerId(int $customerid): self
    {
        $this->customerid = $customerid;

        return $this;
    }

    /**
     * @return Collection<int, InvoiceLine>
     */
    public function getInvoiceLines(): Collection
    {
        return $this->invoiceLines;
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine): self
    {
        if (!$this->invoiceLines->contains($invoiceLine)) {
            $this->invoiceLines[] = $invoiceLine;
            $invoiceLine->setInvoiceId($this);
        }

        return $this;
    }

    public function removeInvoiceLine(InvoiceLine $invoiceLine): self
    {
        if ($this->invoiceLines->removeElement($invoiceLine)) {
            // set the owning side to null (unless already changed)
            if ($invoiceLine->getInvoiceId() === $this) {
                $invoiceLine->setInvoiceId(null);
            }
        }

        return $this;
    }
}
