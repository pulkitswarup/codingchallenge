<?php

namespace App\Tests\Controller;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityNotFoundException;

/**
 * @group wip
 */
class CategoryControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            [
                \App\DataFixtures\CategoryFixture::class,
            ],
            false,
            null,
            'doctrine',
            ORMPurger::PURGE_MODE_TRUNCATE
        );
    }

    public function testGetsAllCategories()
    {
        $response = $this->get('/api/1/category', []);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode('[{"id":108140,"name":"Kellersanierung"},{"id":402020,"name":"Holzdielen schleifen"},{"id":411070,"name":"Fensterreinigung"},{"id":802030,"name":"Abtransport, Entsorgung und Entr\u00fcmpelung"},{"id":804040,"name":"Sonstige Umzugsleistugen"}]', true),
            json_decode($response->getContent(), true)
        );
    }

    public function testGetCategoryById()
    {
        $response = $this->get('/api/1/category/802030', []);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode('{"id":802030,"name":"Abtransport, Entsorgung und Entr\u00fcmpelung"}', true),
            json_decode($response->getContent(), true)
        );
    }

    public function testCategoryNotFound()
    {
        $this->expectException(EntityNotFoundException::class);
        $response = $this->get('/api/1/category/22', []);
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
