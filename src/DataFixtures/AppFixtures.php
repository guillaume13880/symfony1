<?php

namespace App\DataFixtures;

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
        // Plats
        $plat = [];
        for ($p=0; $p <= 19; $p++) {

            $plats = new Plats();
            $plats
               ->setTitle($this->faker->words(3, true))
               ->setImage($this->faker->imageUrl(360, 360, 'animals', true))
               ->setPrix(mt_rand(0, 25))
               ->setDescription($this->faker->text());

            $plat[] = $plats;
            $manager->persist($plats);
        }


        // Menu
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

        //utilisateur
        for ($u=0; $u <= 9; $u++) {

            $user = new User();
            $user
               ->setfullName($this->faker->name())
               ->setEmail($this->faker->email())
               ->setRoles(['ROLE_USER'])
               ->setPlainPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }
}
