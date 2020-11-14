<?php
namespace App\Controller;

use App\Service\BlockUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Dashboard extends AbstractController
{
/**
    * @Route("/", name="dashboard")
*/
    
public function index(): Response
    {
        
        $content = $this->renderView('dashboard.html.twig');
        return new Response($content);
  
    }
}
