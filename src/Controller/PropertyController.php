<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Notification\ContactNotification;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repo;
    
    public function __construct(PropertyRepository $repo)
    {
        $this->repo    = $repo;
    }


    /**
     * Query all the properties from database
     * 
     * @Route("/biens", name="property_index")
     * 
     * @param 
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $this->repo->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties'   => $properties,
            'form'         => $form->createView()
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
     * @param Request $request
     * @param ContactNotification $contactNotification
     * @return Response
     */
    public function show(string $slug, Property $property, Request $request, ContactNotification $contactNotification): Response
    {
        
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property_show', [
                'id'   => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # Handle mail
            $contactNotification->notify($contact);

            $this->addFlash(
                'success',
                "Merci de votre message ! Nous vous recontacterons dès que possible !"
            );

            return $this->redirectToRoute('property_show', [
                'id'   => $property->getId(),
                'slug' => $property->getSlug()
            ]);
        }

        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property'     => $property,
            'form'         => $form->createView()
        ]);
    }
}
