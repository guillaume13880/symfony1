<?php


// src/Controller/HomeController.php
namespace App\Controller;


use App\Repository\PlatsRepository;
use App\Repository\HorairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
     /** 
     * Cette fonction affiche tous les plats dans la page d'acceuil et les Horaires
     * 
    */
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(PlatsRepository $repository, HorairesRepository $repository2, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            8 
        );

        $horaires = $paginator->paginate(
            $repository2->findAll(),
            $request->query->getInt('page', 1),
            1 
        );

        return $this->render('pages/home.html.twig', [
            'plats' => $plats,
            'horaires' =>$horaires
        ]);
    }
}