<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Repository\PlatsRepository;
use App\Form\PlatsType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PlatsController extends AbstractController
{

    /** 
     * Cette fonction affiche tous les plats dans un tableau
     * 
    */


    #[Route('/plats', name: 'app_plats', methods: ['GET'])]
    public function index(PlatsRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $plats = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );

        return $this->render('pages/plats/index.html.twig', [
            'plats' => $plats
        ]);
    }


    /** 
     * Cette fonction permet de créer un plats 
     * 
    */

    #[Route('/plats/nouveau', name: 'app_plats.new', methods: ['GET', 'POST'])]
    public function new(Request $request) : Response
    {
        $plats = new Plats();
        $form = $this->createForm(PlatsType::class , $plats);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plats = $form->getData();
        }

        return $this->render('pages/plats/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
