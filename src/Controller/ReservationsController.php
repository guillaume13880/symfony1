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
}
