<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Repository\PlatsRepository;
use App\Form\PlatsType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PlatsController extends AbstractController
{

    /** 
     * Ce Controller affiche tous les plats dans un tableau avec une pagination
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
     * Ce Controller permet de créer un plats dans un form
     * 
    */

    #[Route('/plats/nouveau', name: 'app_plats.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
        ) : Response
    {
        $plats = new Plats();
        $form = $this->createForm(PlatsType::class , $plats);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plats = $form->getData();

            $manager->persist($plats);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre plats a été créé avec succès !'
            );

            return $this->redirectToRoute('app_plats');
            
        }

        return $this->render('pages/plats/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /** 
     * Ce Controller permet de modifié le plats
     * 
    */
    #[Route('/plats/edition/{id}', 'app_plats.edit',  methods: ['GET', 'POST'])]
    public function edit(
        Plats $plats, 
        Request $request,
        EntityManagerInterface $manager
        ) : Response
    {

        $form = $this->createForm(PlatsType::class , $plats);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plats = $form->getData();

            $manager->persist($plats);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre plat a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_plats');
            
        }

        return $this->render('pages/plats/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /** 
     * Ce Controller permet de supprimer un plats en fonction de l'id saisie
     * 
    */
    #[Route('/plats/suppression/{id}', 'app_plats.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Plats $plats) : Response
    {
        $manager->remove($plats);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre plats a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_plats');
    }
}
