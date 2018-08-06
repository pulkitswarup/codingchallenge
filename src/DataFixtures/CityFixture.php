<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixture extends Fixture
{
    /**
     * Loads the city fixture
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($itr = 1; $itr <= 10; $itr++) {
            $countryId = rand(1, 10);
            $country = new Country();
            $country->setId($countryId);
            $country->setName("Country {$countryId}");

            $city = new City();
            $city->setId($itr);
            $city->setCountry($country);
            $city->setName("City (Country {$city->getCountry()->getName()})");
            $city->setZipCode(rand(10000, 99999));
            $manager->persist($city);
        }
        $manager->flush();
    }
}