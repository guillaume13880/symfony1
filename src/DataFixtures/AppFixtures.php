<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Horaires;
use App\Entity\HorairesReservable;
use App\Entity\Plats;
use App\Entity\Menus;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
   
    private $faker;

    

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
        $this->faker->addProvider(new \Faker\Provider\Internet($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        // Crée 3 categories
        for ($c=0; $c <= 2; $c++) {

            $category = new Category();
            $category
               ->setTitle($this->faker->words(1, true));

            $manager->persist($category);

            // Crée 8 Plats pour chaque categorie
            $plat = [];
            for ($p=0; $p <= 7; $p++) {

                $plats = new Plats();
                $plats
                ->setTitle($this->faker->words(3, true))
                ->setPrix(mt_rand(0, 25))
                ->setDescription($this->faker->text())
                ->setCategory($category);

                $plat[] = $plats;
                $manager->persist($plats);
            }
        }

        // Menus
        $menu = [];
        for ($m=0; $m <= 4; $m++) {

            $menus = new Menus();
            $menus
               ->setTitre($this->faker->words(3, true))
               ->setFormule1($this->faker->words(2, true))
               ->setDescription1($this->faker->words(7, true))
               ->setPrix1(mt_rand(0, 35))

               ->setFormule2($this->faker->words(2, true))
               ->setDescription2($this->faker->words(7, true))
               ->setPrix2(mt_rand(0, 35));
            
            $menu[] = $menus;
            $manager->persist($menus);
        }

        // utilisateurs
        $users = [];
        $admin = new User();
        $admin
            ->setFullname('Administrateur')
            ->setEmail('admin@quai-antique.fr')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPlainPassword('passpass');

        $users[] = $admin;
        $manager->persist($admin);

        for ($u=0; $u <= 9; $u++) {

            $user = new User();
            $user
               ->setfullName($this->faker->name())
               ->setEmail($this->faker->email())
               ->setRoles(['ROLE_USER'])
               ->setPlainPassword('password');

            $users[] = $user;
            $manager->persist($user);
        }

        // horaires
        for ($h=0; $h < 1; $h++) {

            $horaires = new Horaires();
            $horaires
               ->setLuAM($this->faker->words(1, true))
               ->setLuPM($this->faker->words(1, true))
               ->setMaAM($this->faker->words(1, true))
               ->setMaPM($this->faker->words(1, true))
               ->setMeAM($this->faker->words(1, true))
               ->setMePM($this->faker->words(1, true))
               ->setJeAM($this->faker->words(1, true))
               ->setJePM($this->faker->words(1, true))
               ->setVeAM($this->faker->words(1, true))
               ->setVePM($this->faker->words(1, true))
               ->setSaAM($this->faker->words(1, true))
               ->setSaPM($this->faker->words(1, true))
               ->setDiAM($this->faker->words(1, true))
               ->setDiPM($this->faker->words(1, true));
               
            $manager->persist($horaires);
        }

        $manager->flush();
    }
}
