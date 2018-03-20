<?php

namespace App\Service;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class ClientRecipe
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRecipe($id)
    {
        $url = 'http://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' . $id;
        $res = $this->client->request('GET', $url);
        $data = json_decode($res->getBody()->getContents(), true);
        return $data['drinks'];
    }

    public function getRandomRecipe()
    {
        $url = 'http://www.thecocktaildb.com/api/json/v1/1/random.php';
        $res = $this->client->request('GET', $url);
        $data = json_decode($res->getBody()->getContents(), true);
        return $data['drinks'];
    }

    public function getRecipeByName(Request $request)
    {
        $search = $request->request->get('search');
        $url = 'http://www.thecocktaildb.com/api/json/v1/1/search.php?s=' . $search;
        $res = $this->client->request('GET', $url);
        $data = json_decode($res->getBody()->getContents(), true);
        return $data['drinks'];
    }

    public function getRecipeByIngredient(Request $request)
    {
        $search = $request->request->get('search');
        $url = 'http://www.thecocktaildb.com/api/json/v1/1/filter.php?i=' . $search;
        $res = $this->client->request('GET', $url);
        $data = json_decode($res->getBody()->getContents(), true);
        return $data['drinks'];
    }
}