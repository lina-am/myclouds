<?php

namespace App\Controller;

use App\Repository\CloudBoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CloudBoxController extends AbstractController
{
    #[Route('/', name: 'cloudbox_list', methods: ['GET'])]
    public function index(CloudBoxRepository $boxes): Response
    {
        $all = $boxes->findAll();
        
        $html = "<!doctype html><html><body>";
        $html .= "<h1>Liste des CloudBoxes de tous les membres</h1>";
        $html .= "<ul>";
        foreach ($all as $box) {
            $desc = htmlspecialchars((string) $box->getDescription(), ENT_QUOTES);
            $html .= "<li>{$box->getId()} — {$desc}</li>";
        }
        $html .= "</ul>";
        $html .= "</body></html>";
        
        return new Response($html, Response::HTTP_OK, ['content-type' => 'text/html']);
    }
}
