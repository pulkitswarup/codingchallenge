<?php

namespace App\Repository;

use App\Entity\City;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class CityRepository
 * @codeCoverageIgnore
 */
class CityRepository extends ServiceEntityRepository
{
    /**
     * CityRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }
}