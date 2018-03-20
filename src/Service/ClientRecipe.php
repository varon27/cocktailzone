<?php

namespace App\Service;

use GuzzleHttp\Client;

class ClientRecipe
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRandomRecipes()
    {
        $res = $this->client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/random.php');
        $data = json_decode($res->getBody()->getContents(), true);
        return $data['drinks'];
    }

    public function getRecipesBySearch()
    {
        $res = $this->client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/random.php');
        return json_decode($res->getBody()->getContents(), true);
    }
}