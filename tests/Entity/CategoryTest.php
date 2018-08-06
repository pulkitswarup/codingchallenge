<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private $object;

    public function setUp()
    {
        $this->object = new Category();
    }

    public function testGetterSetters()
    {
        $this->object->setId(1);
        $this->object->setName('Category');

        $this->assertEquals(1, $this->object->getId());
        $this->assertEquals('Category', $this->object->getName());
    }
}