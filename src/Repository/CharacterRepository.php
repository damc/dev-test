<?php

namespace App\Repository;

use App\Entity\Character;
use App\Repository\Support\RickAndMortyRepository;

class CharacterRepository extends RickAndMortyRepository
{
    protected const ENDPOINT = 'character';

    public function mapResultArrayToObject(array $result): object
    {
        $result['origin'] = $result['origin']['name'];

        $episodeIds = [];
        foreach ($result['episode'] as $episodeUrl) {
            preg_match('/\/(\d+)$/', $episodeUrl, $matches);
            $episodeIds[] = $matches[1];
        }
        $result['episodeIds'] = $episodeIds;

        return Character::fromArray($result);
    }
}