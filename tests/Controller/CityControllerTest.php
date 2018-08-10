<?php

namespace App\Tests\Controller;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;

class CityControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            [
                \App\DataFixtures\CountryFixture::class,
                \App\DataFixtures\CityFixture::class,
            ],
            false,
            null,
            'doctrine',
            ORMPurger::PURGE_MODE_TRUNCATE
        );
    }

    public function testGetsAllCities()
    {
        $response = $this->get('/api/1/city', []);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode('[{"id":1,"country":{"id":1,"name":"Germany"},"zip_code":10115,"name":"Berlin"},{"id":2,"country":{"id":1,"name":"Germany"},"zip_code":32457,"name":"Porta Westfalica"},{"id":3,"country":{"id":1,"name":"Germany"},"zip_code":1623,"name":"Lommatzsch"},{"id":4,"country":{"id":1,"name":"Germany"},"zip_code":21521,"name":"Hamburg"},{"id":5,"country":{"id":1,"name":"Germany"},"zip_code":6895,"name":"B\u00fclzig"},{"id":6,"country":{"id":1,"name":"Germany"},"zip_code":1612,"name":"Diesbar-Seu\u00dflitz"}]', true),
            json_decode($response->getContent(), true)
        );
    }

    public function testGetCityById()
    {
        $response = $this->get('/api/1/city/1', []);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode('{"id":1,"country":{"id":1,"name":"Germany"},"zip_code":10115,"name":"Berlin"}', true),
            json_decode($response->getContent(), true)
        );
    }

    /**
     * @expectedException Doctrine\ORM\EntityNotFoundException
     */
    public function testCityNotFound()
    {
        $response = $this->get('/api/1/city/22', []);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode('{"error":{"code":500,"message":"Internal Server Error"}}', true),
            json_decode($response->getContent(), true)
        );
    }

    /**
     * Returns response after initiating post request
     *
     * @param string $uri
     * @param array $data
     * @return Response
     */
    private function get($uri, array $data) : Response
    {
        $headers = array('CONTENT_TYPE' => 'application/json');
        $content = json_encode($data);
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', $uri, array(), array(), $headers, $content);

        return $client->getResponse();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
