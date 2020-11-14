<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;

class TopNodesController extends AbstractController
{
    /**
     * @Route("/top/node", name="top_node")
     */
    public function list(int $limit=10): Response
    {
        $store = new Store('/var/cache');
        $client = HttpClient::create();
        $client = new CachingHttpClient($client, $store);
        
        // this won't hit the network if the resource is already in the cache
        $response = $client->request('GET', 'https://bitnodes.io/api/v1/nodes/leaderboard/?limit='.$limit);

        if (200 !== $response->getStatusCode() ) {
            throw new \Exception('Error: unable to load the list.');
        }

        $nodes = $response->toArray();
        $nodes = $nodes["results"];
        

        $response = $this->render('fragments/_nodelist.html.twig', [
            'nodes' => $nodes,
        ]);

        $response->setPublic();
        $response->setMaxAge(6000);

        return $response;
    }
}
