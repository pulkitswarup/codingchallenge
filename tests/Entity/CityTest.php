<?php

namespace App\Tests\Entity;

use App\Entity\City;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new City();
    }

    public function testGetterSetters()
    {
        $country = new Country();

        $this->object->setId(1);
        $this->object->setName('City (Country)');
        $this->object->setCountry($country);
        $this->object->setZipCode(11111);

        $this->assertSame(1, $this->object->getId());
        $this->assertSame('City (Country)', $this->object->getName());
        $this->assertSame($country, $this->object->getCountry());
        $this->assertSame(11111, $this->object->getZipCode());
    }
}