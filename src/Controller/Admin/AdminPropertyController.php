<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository $repo
     * @var ObjectManager $manager
     */
    private $repo;
    private $manager;
    
    public function __construct(PropertyRepository $repo, ObjectManager $manager)
    {
        $this->repo    = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="admin_property_index")
     * 
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin/property/index.html.twig', [
            'properties' => $this->repo->findAll()
        ]);
    }

    /**
     * Adding a new property as Admin
     * 
     * @Route("/admin/property/new", name="admin_property_new")
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($property);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le bien a été enregistré avec succès"
            );

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * Edit property as Admin
     * 
     * @Route("/admin/property/{id}", name="admin_property_edit", methods="GET|POST")
     *
     * @param Property $property
     * @return Response
     */
    public function edit(Property $property, Request $request): Response
    {

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le bien <strong>{$property->getTitle()}</strong> a bien été modifié"
            );

            return $this->redirectToRoute('admin_property_index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form'     => $form->createView()
        ]);
    }


    /**
     * Removing property as Admin
     * 
     * @Route("admin/property/{id}", name="admin_property_delete", methods="DELETE")
     *
     * @param Property $property
     * @return void
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->manager->remove($property);
            $this->manager->flush();
            $this->addFlash(
                'success',
                "Le bien <strong>{$property->getTitle()}</strong> a été correctement supprimé"
            );
        }
        return $this->redirectToRoute('admin_property_index');
    }
}
