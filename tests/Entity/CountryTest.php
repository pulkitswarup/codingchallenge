<?php

namespace App\Tests\Entity\Country;

use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new Country();
    }

    public function testSetterGetters()
    {
        $this->object->setId(1);
        $this->object->setName('Country Name');

        $this->assertSame(1, $this->object->getId());
        $this->assertSame('Country Name', $this->object->getName());
    }
}