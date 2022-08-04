<?php

namespace App\Controller;

use Predis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RedisGetItemController extends AbstractController
{
    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @Route("/get", name="get")
     */
    public function index(Request $request)
    {
        $redisClient = new Client(array(
            "scheme" => "tcp",
            "host" => $this->getParameter("redisHost"),
            "port" => $this->getParameter("redisPort")
        ));
        $query = $request->query->get('query');
        $key = $request->query->get('key');
        $list = $redisClient->keys($query);
        $value = $this->cache->getItem($key)->get();

        return $this->render('get.html.twig', [
            'list' => $list,
            'query' => $query,
            'value' => json_decode($value)
        ]);
    }
}