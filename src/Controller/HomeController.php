<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Get homepage with latest properties
     * 
     * @Route("/", name="homepage")
     * 
     * @param PropertyRepository $repo
     * @return Response
     */
    public function index(PropertyRepository $repo) : Response
    {
        return $this->render('pages/home.html.twig', [
            'latest_properties' => $repo->findLatest() 
        ]);
    }
}
