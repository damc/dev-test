<?php

namespace App\Entity;

use App\Entity\Support\FromArrayTrait;

class Character
{
    use FromArrayTrait;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $species;

    /**
     * @var string
     */
    public $origin;

    /**
     * @var int[]
     */
    public $episodeIds;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Character
     */
    public function setId(int $id): Character
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Character
     */
    public function setName(string $name): Character
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Character
     */
    public function setImage(string $image): Character
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecies(): string
    {
        return $this->species;
    }

    /**
     * @param string $species
     * @return Character
     */
    public function setSpecies(string $species): Character
    {
        $this->species = $species;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     * @return Character
     */
    public function setOrigin(string $origin): Character
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return int[]
     */
    public function getEpisodeIds(): array
    {
        return $this->episodeIds;
    }

    /**
     * @param array $episodeIds
     * @return $this
     */
    public function setEpisodeIds(array $episodeIds): Character
    {
        $this->episodeIds = $episodeIds;
        return $this;
    }
}