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
        // $country = new Country();
        // $country->setId(2);
        // $country->setName("Germany");
        // $metadata = $manager->getClassMetadata(get_class($country));
        // $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
        // $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        // $manager->persist($country);
        // $manager->flush();
    }
}