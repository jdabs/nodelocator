<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlockUtilsController extends AbstractController
{
    /**
     * @Route("/block/utils/{value}", name="block_utils")
     */

    public function price(): Response
    {
        $call = new ApiController();
        $price = $call->call_api('price');

        $response = $this->render('fragments/_utilcontent.html.twig', [
            'content' => $price,
        ]);
        $response->setPublic();
        $response->setMaxAge(6000);

        return $response;
    }

    public function total_nodes(): Response
    {
        $snapshot = new ApiController();
        $snapshot = $snapshot->call_api('snapshot');
        $total_nodes = $snapshot['total_nodes'];

        $response = $this->render('fragments/_utilcontent.html.twig', [
            'content' => $total_nodes,
        ]);
        $response->setPublic();
        $response->setMaxAge(6000);

        return $response;
    }

    public function last_update_time(): Response
    {
        $snapshot = new ApiController();
        $snapshot = $snapshot->call_api('snapshot');
        $last_updated = $snapshot['timestamp'];
        $last_updated = date('M j, Y, g:i a', $last_updated);

        $response = $this->render('fragments/_utilcontent.html.twig', [
            'content' => $last_updated,
        ]);
        $response->setPublic();
        $response->setMaxAge(6000);

        return $response;
    }

    public function blockheight(): Response
    {
        $snapshot = new ApiController();
        $block_height = $snapshot->call_api('blockheight');
        

        $response = $this->render('fragments/_utilcontent.html.twig', [
            'content' => $block_height,
        ]);
        $response->setPublic();
        $response->setMaxAge(6000);

        return $response;
    }
}
