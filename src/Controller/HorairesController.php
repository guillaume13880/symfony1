<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Form\HorairesType;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorairesController extends AbstractController
{

    /** 
     * Ce Controller affiche les Horaires dans un tableau ( + affichage footer = visibilité)
     * 
    */
    #[Route('/horaires', name: 'app_horaires.tableau', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function tableau(HorairesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $horaires = $paginator->paginate(
            $repository->findAll([]),
            $request->query->getInt('page', 1),
            1 
        );

        return $this->render('pages/horaires/tableau.html.twig', [
            'horaires' => $horaires
        ]);
    }
    


    /**
     * Ce Controller permet de modifer les horaires d'ouverture
     */
    #[Route('/horaires/edition/{id}', name: 'app_horaires.edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Horaires $horaires, EntityManagerInterface $manager, Request $request): Response
    {
        
        $form = $this->createForm(HorairesType::class , $horaires);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $horaires = $form->getData();

            $manager->persist($horaires);
            $manager->flush();

            $this->addFlash(
                'success',
                'Les horaires ont bien été modifié !'
            );

            return $this->redirectToRoute('app_horaires.tableau');
            
        }

        return $this->render('pages/horaires/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
