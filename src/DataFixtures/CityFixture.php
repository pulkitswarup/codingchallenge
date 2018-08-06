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
        $cities = [
            [1, '10115', 'Berlin'],
            [2, '32457', 'Porta Westfalica'],
            [3, '01623', 'Lommatzsch'],
            [4, '21521', 'Hamburg'],
            [5, '06895', 'Bülzig'],
            [6, '01612', 'Diesbar-Seußlitz'],
        ];

        $country = new Country();
        $metadata = $manager->getClassMetadata(get_class($country));
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $country->setId(1);
        $country->setName("Germany");
        foreach ($cities as $city) {
            $entity = (new City())
                ->setId($city[0])
                ->setCountry($country)
                ->setName($city[2])
                ->setZipCode($city[1]);
            $metadata = $manager->getClassMetadata(get_class($entity));
            $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $manager->persist($entity);
        }
        $manager->flush();
    }
}