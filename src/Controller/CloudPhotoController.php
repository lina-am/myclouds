<?php

namespace App\Controller;

use App\Entity\CloudPhoto;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CloudPhotoController extends AbstractController
{
    #[Route('/photo/{id}', name: 'photo_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $repo  = $doctrine->getRepository(CloudPhoto::class);
        $photo = $repo->find($id);

        if (!$photo) {
            throw $this->createNotFoundException("La photo #$id est introuvable");
        }

        return $this->render('cloud_photo/show.html.twig', [
            'photo' => $photo,
        ]);
    }
}