<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Repository\MenusRepository;
use App\Form\MenusType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MenusController extends AbstractController
{

    /** 
     * Ce Controller affiche tous les Menus dans un tableau avec une pagination
     * 
    */
    #[Route('/menus', name: 'app_menus', methods: ['GET'])]
    public function index(MenusRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $menus = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );

        return $this->render('pages/menus/index.html.twig', [
            'menus' => $menus
        ]);
    }


    /** 
     * Ce Controller créer un Menus
     * 
    */
    #[Route('/menus/creation', name:'app_menus.new', methods: ['GET', 'POST'])]
    public function new() : Response
    {
        $menus = new Menus();
        $form = $this->createForm(MenusType::class, $menus);

        return $this->render('pages/menus/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
