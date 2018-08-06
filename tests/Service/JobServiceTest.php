<?php

namespace App\Tests\Service;

use Mockery;
use App\Entity\City;
use App\Dto\JobRequest;
use App\Entity\Category;
use App\Service\JobService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class JobServiceTest extends KernelTestCase
{
    private $entityManager;

    private $request;

    private $violations;

    public function setUp()
    {
        $this->entityManager = Mockery
            ::mock(EntityManagerInterface::class)
            ->makePartial();

        $this->entityManager->shouldReceive('persist')->andReturn(true);
        $this->entityManager->shouldReceive('flush')->andReturn(true);

        $this->request = Mockery::mock(JobRequest::class)->makePartial();
    }

    public function testCreateJob()
    {
        $this->entityManager
             ->shouldReceive('getReference')
             ->with(Category::class, 1)
             ->andReturn(new Category());

             $this->entityManager
             ->shouldReceive('getReference')
             ->with(City::class, 1)
             ->andReturn(new City());

        $service = new JobService($this->entityManager);
        $this->request->setTitle('This is sample title');
        $this->request->setDescription('This is sample description');
        $this->request->setCategory(1);
        $this->request->setCity(1);
        $this->request->setZipCode(11111);
        $this->request->setExecuteAt(date_create('now'));

        $response = $service->create($this->request);

        $this->assertObjectHasAttribute('id', $response);
        $this->assertObjectHasAttribute('title', $response);
        $this->assertObjectHasAttribute('description', $response);
        $this->assertObjectHasAttribute('category', $response);
        $this->assertObjectHasAttribute('city', $response);
        $this->assertObjectHasAttribute('zip_code', $response);
        $this->assertObjectHasAttribute('execute_at', $response);
        $this->assertObjectHasAttribute('created_at', $response);
        $this->assertObjectHasAttribute('updated_at', $response);
    }

    public function tearDown()
    {
        Mockery::close();
        parent::tearDown();
    }
}