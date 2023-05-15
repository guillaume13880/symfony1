<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Reservations;
use App\Form\ReservationsType;
use App\Repository\CalendarRepository;
use App\Repository\ReservationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager, HorairesRepository $repo, PaginatorInterface $paginator,): Response
    {
        /**
         * Ce Controller permet de créer une Reservation dans un Form 
         */  
        //$query = $manager->createQuery('SELECT SUM(nb_couvert) FROM reservations');
        $horaires = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            1 
        );

        $reservation = new Reservations();
        $form = $this->createForm(ReservationsType::class, $reservation);       
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            

            $manager->persist($reservation);
            $manager->flush();

            $this->addFlash(
                'success',
                'Vôtre réservation a été créer avec succès, vous allez recevoir un email prochainement !'
            );

            return $this->redirectToRoute('home.index');
            
        }

        return $this->render('pages/reservations/index.html.twig', [
            'form' => $form->createView(),
            'horaires' =>$horaires
        ]);
    }


    /** 
     * Ce Controller affiche toutes les réservations dans un tableau avec une pagination
     * 
    */
    #[Route('/reservations/tableau', name: 'app_reservations.tableau', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function tableau(ReservationsRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $reservations = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10 
        );

        return $this->render('pages/reservations/tableau.html.twig', [
            'reservations' => $reservations
        ]);
    }

    /** 
     * Ce Controller permet de modifié les reservations
     * 
    */
    #[Route('/reservations/edition/{id}', 'app_reservations.edit',  methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(
        Reservations $reservations, 
        Request $request,
        EntityManagerInterface $manager
        ) : Response
    {

        $form = $this->createForm(ReservationsType::class , $reservations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reservations = $form->getData();

            $manager->persist($reservations);
            $manager->flush();

            $this->addFlash(
                'success',
                'La réservation a été modifié avec succès !'
            );

            return $this->redirectToRoute('app_reservations.tableau');
            
        }

        return $this->render('pages/reservations/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /** 
     * Ce Controller permet de supprimer une reservations en fonction de l'id saisie
     * 
    */
    #[Route('/reservations/suppression/{id}', 'app_reservations.delete', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(EntityManagerInterface $manager, Reservations $reservations) : Response
    {
        $manager->remove($reservations);
        $manager->flush();

        $this->addFlash(
            'success',
            'La reservations a été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_reservations.tableau');
    }
}
