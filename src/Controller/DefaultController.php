<?php

namespace App\Controller;

use GuzzleHttp\Client;
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
/**/
    }

    /**
     * @Route("/", name="all_cocktails")
     */
    public function getAllAction()
    {
        return $this->render('cocktails.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        if ($request->isMethod('POST')){

            $search = $request->request->get('search');
            $client = new Client();
            $res = $client->request('GET', 'http://www.thecocktaildb.com/api/json/v1/1/filter.php?i=' . $search);
            $results = json_decode($res->getBody()->getContents());

            $results = $results->drinks;

            return $this->render('result.html.twig', array(
                'drinks' => $results
            ));
        }




    }
}