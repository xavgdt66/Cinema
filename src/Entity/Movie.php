<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

////////////////////////////////////////////////////////////
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
////////////////////////////////////////////////////////////
#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titlemovie = null;

    #[ORM\Column(length: 255)]
    private ?string $Content = null;
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////


    #[ORM\OneToMany(targetEntity: Horaire::class, mappedBy: "movie", cascade: ["persist", "remove"])]
    private $horaires;

    public function __construct()
    {
        $this->horaires = new ArrayCollection();
    }

    /**
     * @return Collection|Horaire[]
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(Horaire $horaire): self
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires[] = $horaire;
            $horaire->setMovie($this);
        }

        return $this;
    }

    public function removeHoraire(Horaire $horaire): self
    {
        if ($this->horaires->removeElement($horaire)) {
            // set the owning side to null (unless already changed)
            if ($horaire->getMovie() === $this) {
                $horaire->setMovie(null);
            }
        }

        return $this;
    }

    /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlemovie(): ?string
    {
        return $this->Titlemovie;
    }

    public function setTitlemovie(string $Titlemovie): static
    {
        $this->Titlemovie = $Titlemovie;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): static
    {
        $this->Content = $Content;

        return $this;
    }
}
