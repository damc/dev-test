<?php

namespace App\Entity\Support;

trait FromArrayTrait
{
    public static function fromArray(array $data = []): self
    {
        $entity = new self;
        $properties = get_object_vars($entity);

        foreach ($properties as $property => $default) {
            if (!array_key_exists($property, $data)) {
                continue;
            }
            $entity->{$property} = $data[$property];
        }
        return $entity;
    }
}