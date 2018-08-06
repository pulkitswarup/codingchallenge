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
        for ($itr = 1; $itr <= 10; $itr++) {
            $category = new Category();
            $category->setName('Category '. $itr);
            $manager->persist($category);
        }
        $manager->flush();
    }
}