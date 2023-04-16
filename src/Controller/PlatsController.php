<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{

    /** 
     * Cette fonction affiche tous les plats 
     * 
    */


    #[Route('/plats', name: 'app_plats', methods: ['GET'])]
    public function index(PlatsRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            6 
        );

        return $this->render('pages/plats/index.html.twig', [
            'plats' => $plats
        ]);
    }
}
