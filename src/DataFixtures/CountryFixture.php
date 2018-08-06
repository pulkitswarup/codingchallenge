<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CountryFixture extends Fixture
{
    /**
     * Loads the country fixture
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($itr = 1; $itr <= 10; $itr++) {
            $country = new Country();
            $country->setName('Country ' . $itr);
            $manager->persist($country);
        }
        $manager->flush();
    }
}