<?php

namespace App\Repository\Support;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class RickAndMortyRepository
{
    protected const ENDPOINT = null;
    protected const CACHE_TTL = 86400;

    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var AdapterInterface
     */
    protected $cache;

    public function __construct(HttpClientInterface $rickAndMortyApiClient, AdapterInterface $cache)
    {
        $this->client = $rickAndMortyApiClient;
        $this->cache = $cache;
    }

    public function find($id): object
    {
        $path = static::ENDPOINT . '/' . $id;
        $result = $this->request($path);

        return $this->mapResultArrayToObject($result);
    }

    /**
     * @param mixed[mixed] $criteria
     * @param int $page
     * @return object[]
     */
    public function findBy(array $criteria, int $page = 1): array
    {
        $parameters = array_merge($criteria, ['page' => $page]);
        $path = static::ENDPOINT . '?' . http_build_query($parameters);

        $results = $this->request($path)['results'];
        $objects = [];

        foreach ($results as $result) {
            $objects[] = $this->mapResultArrayToObject($result);
        }

        return $objects;
    }

    public function getTotalPagesBy(array $criteria): int
    {
        $parameters = array_merge($criteria, ['page' => 1]);
        $path = static::ENDPOINT . '?' . http_build_query($parameters);

        return $this->request($path)['info']['pages'];
    }

    /**
     * @param int $page
     * @return object[]
     */
    public function findAll(int $page = 1): array
    {
        return $this->findBy([], $page);
    }

    public function getTotalPages(): int
    {
        return $this->getTotalPagesBy([]);
    }

    protected function request(string $path): array
    {
        return $this->cache->get(
            str_replace('/', '.', $path),
            function (ItemInterface $item) use ($path): array {
                $item->expiresAfter(static::CACHE_TTL);

                $response = $this->client->request('GET', $path);
                return $response->toArray();
            }
        );
    }

    abstract protected function mapResultArrayToObject(array $result): object;
}