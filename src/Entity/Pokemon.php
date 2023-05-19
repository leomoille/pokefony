<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
    ],
    normalizationContext: ['groups' => ['pokemon']]
)]
#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Pokédex number
     */
    #[ORM\Column]
    private ?int $number = null;

    /**
     * Pokémon name
     */
    #[Groups(['pokemon', 'move', 'type'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * Pokémon height
     */
    #[ORM\Column]
    private ?int $height = null;

    /**
     * Pokémon types
     */
    #[Groups(['pokemon'])]
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'pokemon', fetch: "EAGER")]
    private Collection $types;

    /**
     * Pokémon moves
     */
    #[Groups(['pokemon'])]
    #[ORM\ManyToMany(targetEntity: Move::class, inversedBy: 'pokemon', fetch: "EAGER")]
    private Collection $moves;

    /**
     * Pokémon sprite
     */
    #[ORM\Column(length: 255)]
    private ?string $sprite = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->moves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, Move>
     */
    public function getMoves(): Collection
    {
        return $this->moves;
    }

    public function addMove(Move $move): self
    {
        if (!$this->moves->contains($move)) {
            $this->moves->add($move);
        }

        return $this;
    }

    public function removeMove(Move $move): self
    {
        $this->moves->removeElement($move);

        return $this;
    }

    public function getSprite(): ?string
    {
        return $this->sprite;
    }

    public function setSprite(string $sprite): self
    {
        $this->sprite = $sprite;

        return $this;
    }
}
