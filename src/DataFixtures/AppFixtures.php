<?php

namespace App\DataFixtures;

use App\Entity\Plats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

        for ($i=0; $i <= 20; $i++) {

            $plats = new Plats();
            $plats
               ->setTitle($this->faker->word())
               ->setImage($this->faker->imageUrl(360, 360, 'animals', true))
               ->setPrix(mt_rand(0, 25))
               ->setDescription($this->faker->text());

            $manager->persist($plats);
        }

        $manager->flush();
    }
}
