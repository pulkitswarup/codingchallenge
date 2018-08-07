<?php

namespace App\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Routing\ClassResourceInterface;
use App\Entity\Category;

/**
 * class CategoryController
 * @Rest\NoRoute()
 */
class CategoryController extends FOSRestController implements ClassResourceInterface
{
    /** @var CategoryRepository $repository */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Returns all the categories
     * @Rest\Get(path="category")
     * @Rest\View()
     *
     * @return array
     */
    public function getAll() : array
    {
        return $this->repository->findAll();
    }

    /**
     * Returns category by requested id
     * @Rest\Get(path="category/{id}", requirements={"id"="\d+"})
     * @Rest\View()
     *
     * @return Category
     */
    public function get(string $id) : Category
    {
        /** @var Category|null $category */
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new EntityNotFoundException('category not found');
        }

        return $category;
    }
}
