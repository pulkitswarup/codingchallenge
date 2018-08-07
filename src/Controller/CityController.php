<?php

namespace App\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Routing\ClassResourceInterface;
use App\Entity\City;

/**
 * class CityController
 * @Rest\NoRoute()
 */
class CityController extends FOSRestController implements ClassResourceInterface
{
    /** @var CityRepository $repository */
    private $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns all the cities
     * @Rest\Get(path="city")
     * @Rest\View()
     *
     * @return array
     */
    public function getAll() : array
    {
        return $this->repository->findAll();
    }

    /**
     * Returns city by requested id
     * @Rest\Get(path="city/{id}", requirements={"id"="\d+"})
     * @Rest\View()
     *
     * @return City
     */
    public function get(string $id) : City
    {
        /** @var City|null $city */
        $city = $this->repository->find($id);

        if (null === $city) {
            throw new EntityNotFoundException('city not found');
        }

        return $city;
    }
}
