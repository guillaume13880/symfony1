<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    /**
     * Ce Controller affiche tous les plats part categorie dans la Carte
     */
    #[Route('/carte', name: 'app_carte', methods: ['GET'])]
    public function index(PlatsRepository $repository, Request $request): Response
    {
        $plats = 
            $repository->findBy(["category" => "1"]);
            $request->query->getInt('page', 1);

        $plats2 =
            $repository->findBy(["category" => "2"]);
            $request->query->getInt('page', 1);

        $plats3 =
            $repository->findBy(["category" => "3"]);
            $request->query->getInt('page', 1);
            

        return $this->render('pages/carte/index.html.twig', [
            'plats' => $plats,
            'plats2' => $plats2,
            'plats3' => $plats3
        ]);
    }
}
