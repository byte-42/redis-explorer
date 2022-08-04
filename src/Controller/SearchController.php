<?php

namespace App\Controller;

use Predis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request)
    {
        $redisClient = new Client(array(
            "scheme" => "tcp",
            "host" => $this->getParameter("redisHost"),
            "port" => $this->getParameter("redisPort")
        ));
        $query = $request->query->get('query');
        $list = $redisClient->keys($query);

        return $this->render('search.html.twig', [
            'list' => $list,
            'query' => $query
        ]);
    }
}