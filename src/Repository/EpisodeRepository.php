<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\Episode;
use App\Repository\Support\RickAndMortyRepository;
use InvalidArgumentException;

class EpisodeRepository extends RickAndMortyRepository
{
    protected const ENDPOINT = 'episode';

    /**
     * @param Character $character
     * @return Episode[]
     */
    public function findByCharacter(Character $character): array
    {
        $path = self::ENDPOINT . '/' . implode(', ', $character->getEpisodeIds());
        $result = $this->request($path);

        if (is_null($result)) {
            throw new InvalidArgumentException('Character with this ID does not exist.');
        }

        if (count($character->getEpisodeIds()) != 1) {
            $episodes = [];

            foreach ($result as $episodeArray) {
                $episodes[] = $this->mapResultArrayToObject($episodeArray);
            }
        } else {
            $episodes = [$this->mapResultArrayToObject($result)];
        }

        return $episodes;
    }

    protected function mapResultArrayToObject(array $result): object
    {
        return Episode::fromArray($result);
    }
}