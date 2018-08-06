<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    /**
     * Loads the category fixture
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $categories = [
            [804040, 'Sonstige Umzugsleistugen'],
            [802030, 'Abtransport, Entsorgung und Entrümpelung'],
            [411070, 'Fensterreinigung'],
            [402020, 'Holzdielen schleifen'],
            [108140, 'Kellersanierung'],
        ];

        foreach ($categories as $category) {
            $entity = (new Category())
                ->setId($category[0])
                ->setName($category[1]);
            $metadata = $manager->getClassMetadata(get_class($entity));
            $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
            $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
            $manager->persist($entity);
        }
        $manager->flush();
    }
}