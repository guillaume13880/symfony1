<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{

    /** 
     * Ce Controller permet la modification du profil utilisateur
    */ 
    #[Route('/utilisateur/edition/{id}', name: 'app_user.edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {
        // Si l'utilisateur courant est connecté, sinon renvoie sur le form de connexion
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_security.login');
        }

        // Si l'utilisateur courant et le different que l'id recupérer au niveau de la route renvoie sur la page d'accueil 
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('home.index');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())) {
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();
                
                $this->addFlash(
                    'success',
                    'Les informations de votre compte ont bien été modifiées '
                );
    
                return $this->redirectToRoute('home.index');
            }else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect '
                );
            }

        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Ce controller permet de modifier le mot de passe
     */
    #[Route('/utilisateur/edition-mot-de-passe/{id}', name: 'app_user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(User $user, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher) : Response
    {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])) {
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->getData()['newPassword']
                    )
                );

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié avec succès'
                );

                return $this->redirectToRoute('home.index');

            }else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect '
                );
            }
        }

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
