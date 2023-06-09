<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Repository\MenusRepository;
use App\Repository\HorairesRepository;
use App\Form\MenusType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MenusController extends AbstractController
{
    /** 
     * Ce Controller affiche tous les Menus dans la page d'acceuil avec une pagination ainsi que les horaires dans le footer
     * 
    */
    #[Route('/menus', name: 'app_menus', methods: ['GET'])]
    public function index(MenusRepository $repository, HorairesRepository $repository2, PaginatorInterface $paginator, Request $request): Response
    {
        $menus = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            1 
        );

        $horaires = $paginator->paginate(
            $repository2->findAll(),
            $request->query->getInt('page', 1),
            1 
        );

        return $this->render('pages/menus/index.html.twig', [
            'menus' => $menus,
            'horaires' => $horaires
        ]);
    }


    /** 
     * Ce Controller affiche tous les Menus dans un tableau avec une pagination
     * 
    */
    #[Route('/menus/tableau', name: 'app_menus.tableau', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function tableau(MenusRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $menus = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5 
        );

        return $this->render('pages/menus/tableau.html.twig', [
            'menus' => $menus
        ]);
    }


    /** 
     * Ce Controller permet de créer un Menus
     * 
    */
    #[Route('/menus/creation', name:'app_menus.new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $manager) : Response
    {
        $menus = new Menus();
        $form = $this->createForm(MenusType::class, $menus);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $menus = $form->getData();

            $manager->persist($menus);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre menu a été créé avec succès !'
            );

            return $this->redirectToRoute('app_menus.tableau');
        }

        return $this->render('pages/menus/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /** 
     * Ce Controller permet de modifié un menu
     * 
    */
    #[Route('/menus/edition/{id}', 'app_menus.edit',  methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(
        Menus $menus, 
        Request $request,
        EntityManagerInterface $manager
        ) : Response
    {

        $form = $this->createForm(MenusType::class , $menus);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $menus = $form->getData();

            $manager->persist($menus);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre menu a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_menus.tableau');
            
        }

        return $this->render('pages/menus/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /** 
     * Ce Controller permet de supprimer un menu en fonction de l'id saisie
     * 
    */
    #[Route('/menus/suppression/{id}', 'app_menus.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(EntityManagerInterface $manager, Menus $menus) : Response
    {
        $manager->remove($menus);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre menu a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_menus.tableau');
    }
    
}
