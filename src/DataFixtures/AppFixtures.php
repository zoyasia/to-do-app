<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 7; $i++) {
        $isCompleted = $faker->boolean();
        $task = new Task();
        $task
        ->setTitle($faker->word)
        ->setDescription($faker->sentence)
        ->setDeadline('23/11/2024')
        ->setIsCompleted($isCompleted)
        ->setStatus($isCompleted ? 'terminée' : 'à faire');
        
        $manager->persist($task);
        }


        $manager->flush();
    }
}
