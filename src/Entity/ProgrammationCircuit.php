<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DomCrawler\Image;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgrammationCircuitRepository")
 */
class ProgrammationCircuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nombrePersonnes;

    /**
     * @ORM\Column(type="smallint")
     */
    private $prix;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Circuit", inversedBy="programmationCircuits")
     * @ORM\JoinColumn(nullable=false)
     */
    
    private $circuit;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
   
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getNombrePersonnes(): ?int
    {
        return $this->nombrePersonnes;
    }

    public function setNombrePersonnes(int $nombrePersonnes): self
    {
        $this->nombrePersonnes = $nombrePersonnes;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCircuit(): ?Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(?Circuit $circuit): self
    {
        $this->circuit = $circuit;

        return $this;
    }
    
    
    public function getImg(): ?string
    {
        return $this->img;
    }
    
    public function setImg(string $img): self
    {
        $this->img = $img;
        
        return $this;
    }
    


   

   
}
