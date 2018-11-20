<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{
  /**
   * Allow admin to delete picture with AJAX
   * 
   * @Route("/{id}", name="admin_picture_delete", methods="DELETE")
   * 
   * @param Picture $picture
   * @param Request $request
   * @return JsonResponse
   */
  public function delete (Picture $picture, Request $request)
  {
    $data = json_decode($request->getContent(), true);

    if ($this->isCsrfTokenValid('delete'.$picture->getId(), $data['_token'])) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($picture);
      $em->flush();

      $this->addFlash(
          'success',
          'L\'image a bien été supprimée'
      );

      return new JsonResponse(['success' => 1]);
    }

    return new JsonResponse(['error' => 'Token invalide'], 400);

  }
}