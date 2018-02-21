<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');

    }

    /**
     * @Route("/search", name="search_ingredients")
     */
    public function searchAction(Request $request)
    {
        if ($request->isMethod('POST')){

            $search = $request->request->get('search');
            /*dump($request); die();*/
            $client = new Client();
            $res = $client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/filter.php?i=' . $search);
            $results = json_decode($res->getBody()->getContents());
            /*dump($results); die();*/
            $results = $results->drinks;

            return $this->render('result.html.twig', array(
                'drinks' => $results,
                'search' => $search
            ));
        }
    }

    /**
     * Find and display a recipe.
     *
     * @Route("/{id}", name="recipe")
     * @Method("GET")
     */
    public function recipeAction($id)
    {
            $url = 'http://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' . $id;
            $client = new Client();
            $res = $client->request('GET', $url);
            $results = json_decode($res->getBody()->getContents());

            $results = $results->drinks;

            return $this->render('recipe.html.twig', array(
                'drinks' => $results
            ));
    }

    /**
     * @Route("/searchcocktail", name="search_cocktail")
     */
    public function cocktailSearchAction(Request $request)
    {
        if ($request->isMethod('POST')){

            $search = $request->request->get('search');
            $client = new Client();
            $res = $client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/search.php?s=' . $search);
            $results = json_decode($res->getBody()->getContents());
            /*     dump($results); die();*/

            $results = $results->drinks;

            return $this->render('result.html.twig', array(
                'drinks' => $results,
                'search' => $search
            ));
        }
    }

    /**
     * @Route("/random", name="random")
     */
    public function randomSearchAction(Request $request)
    {
        if ($request->isMethod('POST')){

            $client = new Client();
            $res = $client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/random.php');
            $results = json_decode($res->getBody()->getContents());
            /*     dump($results); die();*/

            $results = $results->drinks;

            return $this->render('recipe.html.twig', array(
                'drinks' => $results
            ));
        }
    }
}