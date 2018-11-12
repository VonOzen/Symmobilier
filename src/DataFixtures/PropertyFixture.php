<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) { 
            $property = new Property();

            $property->setTitle($faker->words(mt_rand(2,4), true))
                     ->setDescription($faker->sentences(mt_rand(2,5), true))
                     ->setSurface($faker->numberBetween(10, 400))
                     ->setRooms($faker->numberBetween(2, 10))
                     ->setBedrooms($faker->numberBetween(1, 9))
                     ->setFloor($faker->numberBetween(0, 20))
                     ->setPrice($faker->numberBetween(50000, 1000000))
                     ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                     ->setCity($faker->city)
                     ->setAddress($faker->address)
                     ->setPostalCode($faker->postcode)
                     ->setSold(false);

            $manager->persist($property);
            $manager->flush();
        }
    }
}
