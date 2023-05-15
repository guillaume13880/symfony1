<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(PlatsRepository $repository, HorairesRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = 
            $repository->findBy(["category" => "1"]);

        $plats2 =
            $repository->findBy(["category" => "2"]);    

        $plats3 =
            $repository->findBy(["category" => "3"]);
        
        $horaires = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            1 
        );

        return $this->render('pages/carte/index.html.twig', [
            'plats' => $plats,
            'plats2' => $plats2,
            'plats3' => $plats3,
            'horaires' =>$horaires
        ]);
    }
}
