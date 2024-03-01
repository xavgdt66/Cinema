<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Movie; // Pour la relation entre la table Movie 

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $Days = null;

    #[ORM\Column(type: 'datetime')]
    private $startMovie;

/////////////////////////////////////////////////////////


/* @ORM\ManyToOne: Cela indique qu'il s'agit d'une relation "Many-to-One", ce qui signifie que plusieurs enregistrements
 de la table des horaires peuvent être associés à un seul enregistrement de la table des films. 
C'est logique car un film peut avoir plusieurs horaires de projection, mais chaque horaire appartient à un seul film.*/

/* targetEntity="App\Entity\Film": Cela indique à Doctrine, le gestionnaire d'entités de Symfony, 
quelle entité est associée à cette relation. Dans ce cas, la relation est avec l'entité Film.*/

/* inversedBy="horaires": Cela spécifie le nom de la propriété dans l'entité cible (Film) qui fait référence
 à cette entité (Horaires). Dans l'entité Film, il devrait y avoir une propriété nommée horaires qui 
 représente la relation inverse. Cela permet à Doctrine de naviguer de Film vers Horaires et vice versa. */

/* @ORM\JoinColumn(nullable=false): Cela spécifie que cette relation est obligatoire,
c'est-à-dire qu'un horaire doit être associé à un film. L'option nullable=false signifie que la colonne correspondante dans
la table des horaires (dans ce cas, la colonne film_id) ne peut pas être nulle.*/

    #[ORM\ManyToOne(targetEntity: Movie::class, inversedBy:"horaire")]
    #[ORM\JoinColumn(nullable: true)]
    private $movie; 

    
    public function getmovie(): ?movie
    {
        return $this->movie;
    }

    public function setmovie(?movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
/////////////////////////////////////////////////////////
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDays(): ?string
    {
        return $this->Days;
    }

    public function setDays(string $Days): static
    {
        $this->Days = $Days;

        return $this;
    }

    public function getstartMovie(): ?\DateTimeInterface
    {
        return $this->startMovie;
    }

    public function setstartMovie(\DateTimeInterface $startMovie): self
    {
        $this->startMovie = $startMovie;

        return $this;
    }
}
