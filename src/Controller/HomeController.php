<?php


// src/Controller/HomeController.php
namespace App\Controller;


use App\Repository\PlatsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
     /** 
     * Cette fonction affiche tous les plats dans la page d'acceuil
     * 
    */
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(PlatsRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            8 
        );

        return $this->render('pages/home.html.twig', [
            'plats' => $plats
        ]);
    }
}