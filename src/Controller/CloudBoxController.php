<?php

namespace App\Controller;

use App\Entity\CloudBox;
use App\Repository\CloudBoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CloudBoxController extends AbstractController
{
    /**
     * Liste de toutes les CloudBoxes
     */
    #[Route('/', name: 'cloudbox_list', methods: ['GET'])]
    public function index(CloudBoxRepository $boxes): Response
    {
        // Récupération de toutes les CloudBoxes depuis la base
        $allBoxes = $boxes->findAll();

        // Rendu de la vue Twig (plus de HTML écrit ici)
        return $this->render('cloud_box/index.html.twig', [
            'boxes' => $allBoxes,
        ]);
    }

    /**
     * Fiche d’une CloudBox (affichage d’un seul élément)
     */
    #[Route('/cloudbox/{id}', name: 'cloudbox_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(CloudBox $box): Response
    {
        // Symfony injecte automatiquement la CloudBox correspondante à l'id
        return $this->render('cloud_box/show.html.twig', [
            'box' => $box,
        ]);
    }
}