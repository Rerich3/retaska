<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtuctsRepository")
 */
class Protucts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Produkt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $no;

    /**
     * @ORM\Column(type="float")
     */
    private $Cena;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdukt(): ?string
    {
        return $this->Produkt;
    }

    public function setProdukt(string $Produkt): self
    {
        $this->Produkt = $Produkt;

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getCena(): ?float
    {
        return $this->Cena;
    }

    public function setCena(float $Cena): self
    {
        $this->Cena = $Cena;

        return $this;
    }
}
