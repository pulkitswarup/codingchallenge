<?php

namespace App\Service;

use App\Entity\Job;
use App\Entity\City;
use App\Entity\Category;
use App\Dto\JobRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class JobService
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * JobService Constructor
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Method creates a new job
     *
     * @param JobRequest $request
     *
     * @return Job
     */
    public function create(JobRequest $request) : Job
    {
        /** @var Category $category */
        $category = $this->entityManager->getReference(
            Category::class, $request->getCategory()
        );

        /** @var City $city */
        $city = $this->entityManager->getReference(
            City::class, $request->getCity()
        );

        $job = new Job();
        $job->setCategory($category);
        $job->setTitle($request->getTitle());
        $job->setDescription($request->getDescription());
        $job->setExecuteAt($request->getExecuteAt());
        $job->setCity($city);
        $job->setZipCode($request->getZipCode());

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        return $job;
    }
}