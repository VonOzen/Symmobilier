<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    /**
     * Query all the properties from database
     * 
     * @Route("/biens", name="property_index")
     * 
     * @param ObjectManager $manager
     * @param PropertyRepository $repo
     * @return Response
     */
    public function index(ObjectManager $manager, PropertyRepository $repo) : Response
    {
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'   => $repo->findAllVisible()
        ]);
    }

    /**
     * Show a single property
     * 
     * @Route("/biens/{slug}-{id}", name="property_show", requirements={"slug": "[a-z0-9\-]*"})
     *
     * @param String $slug
     * @param Integer $id
     * @param Property $property
     * @return Response
     */
    public function show(string $slug, Property $property): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property_show', [
                'id'   => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property'     => $property
        ]);
    }
}
