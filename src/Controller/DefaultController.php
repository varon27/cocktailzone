<?php

namespace App\Controller;

use App\Service\ClientRecipe;
use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\DisplayRecipe;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }

    /**
     * search a cocktail by ingredient
     * @Route("/search", name="search_ingredients")
     *
     */
    public function searchAction(Request $request, ClientRecipe $displayRecipe)
    {
        if ($request->isMethod('POST')){
            return $this->render('result.html.twig', array(
                'drinks' => $displayRecipe->getRecipeByIngredient($request),
                'search' => $request->request->get('search')
            ));
        }
    }

    /**
     * search by cocktail name
     * @Route("/searchcocktail", name="search_cocktail")
     */
    public function cocktailSearchAction(Request $request, ClientRecipe $displayRecipe)
    {
        if ($request->isMethod('POST')){
            return $this->render('result.html.twig', array(
                'drinks' => $displayRecipe->getRecipeByName($request),
                'search' => $request->request->get('search')
            ));
        }
    }

    /**
     * Find and display a recipe.
     * @Route("/{id}", name="recipe")
     * @Method("GET")
     */
    public function recipeAction($id, Request $request, ClientRecipe $displayRecipe)
    {
        return $this->render('recipe.html.twig', array(
            'drinks' => $displayRecipe->getRecipe($id),
        ));
    }

    /**
     * random search
     * @Route("/random", name="random")
     */
    public function randomSearchAction(Request $request, ClientRecipe $displayRecipe)
    {
        if ($request->isMethod('POST')){
            return $this->render('recipe.html.twig', array(
                'drinks' => $displayRecipe->getRandomRecipe(),
            ));
        }
    }
}