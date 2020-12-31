<?php

namespace App\Entity;

use App\Entity\Support\FromArrayTrait;

class Episode
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Episode
     */
    public function setId(int $id): Episode
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
     * @return Episode
     */
    public function setName(string $name): Episode
    {
        $this->name = $name;
        return $this;
    }
}