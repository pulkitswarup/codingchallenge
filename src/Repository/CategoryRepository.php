<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class CategoryRepository
 * @codeCoverageIgnore
 */
class CategoryRepository extends ServiceEntityRepository
{
    /**
     * CityRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
}