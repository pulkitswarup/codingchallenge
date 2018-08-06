<?php

namespace App\Tests\Entity\Job;

use App\Entity\Job;
use App\Entity\City;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new Job();
    }

    public function testSetterGetters()
    {
        $now = date_create('now');
        $city = new City();
        $category = new Category();

        $this->object->setId(1);
        $this->object->setTitle('Sample Title');
        $this->object->setDescription('Sample Description');
        $this->object->setCity($city);
        $this->object->setZipCode(11111);
        $this->object->setCategory($category);
        $this->object->setExecuteAt($now);

        $this->assertSame(1, $this->object->getId());
        $this->assertSame('Sample Title', $this->object->getTitle());
        $this->assertSame('Sample Description', $this->object->getDescription());
        $this->assertSame($city, $this->object->getCity());
        $this->assertSame(11111, $this->object->getZipCode());
        $this->assertSame($category, $this->object->getCategory());
        $this->assertSame($this->object->getCreatedAt(), $this->object->getUpdatedAt());
        $this->assertSame($now, $this->object->getExecuteAt());
    }
}