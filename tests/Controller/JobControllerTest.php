<?php

namespace App\Tests\Controller;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class JobControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->loadFixtures(
            [
                \App\DataFixtures\CategoryFixture::class,
                \App\DataFixtures\CountryFixture::class,
                \App\DataFixtures\CityFixture::class,
            ],
            false,
            null,
            'doctrine',
            ORMPurger::PURGE_MODE_TRUNCATE
        );
    }

    /**
     * @dataProvider postJobPayload
     */
    public function testPostJob($data, $status, $content)
    {
        $response = $this->post('/api/1/job', $data);
        $this->assertEquals($status, $response->getStatusCode());
        $this->assertArraySubset(
            json_decode($content, true),
            json_decode($response->getContent(), true)
        );
    }

    public function postJobPayload()
    {
        $datetime = (new \DateTime('+3 hours'))->format('Y-m-d H:i:s');
        return [
            [
                [],
                'status' => 400,
                'content' => '[{"property_path":"title","message":"This value should not be blank."},{"property_path":"description","message":"This value should not be blank."},{"property_path":"city","message":"This value should not be blank."},{"property_path":"zip_code","message":"This value should not be blank."},{"property_path":"execute_at","message":"This value should not be blank."},{"property_path":"category","message":"This value should not be blank."}]'
            ],
            [
                ['title' => 'xxxx'],
                'status' => 400,
                'content' => '[{"property_path":"title","message":"This value is too short. It should have 5 characters or more."},{"property_path":"description","message":"This value should not be blank."},{"property_path":"city","message":"This value should not be blank."},{"property_path":"zip_code","message":"This value should not be blank."},{"property_path":"execute_at","message":"This value should not be blank."},{"property_path":"category","message":"This value should not be blank."}]'
            ],
            [
                ['title' => 'This is a sample title'],
                'status' => 400,
                'content' => '[{"property_path":"description","message":"This value should not be blank."},{"property_path":"city","message":"This value should not be blank."},{"property_path":"zip_code","message":"This value should not be blank."},{"property_path":"execute_at","message":"This value should not be blank."},{"property_path":"category","message":"This value should not be blank."}]'
            ],
            [
                ['title' => 'This is a simple title', 'description' => 'This is sample description'],
                'status' => 400,
                'content' => '[{"property_path":"city","message":"This value should not be blank."},{"property_path":"zip_code","message":"This value should not be blank."},{"property_path":"execute_at","message":"This value should not be blank."},{"property_path":"category","message":"This value should not be blank."}]'

            ],
            [
                ['title' => 'This is a sample title', 'description' => 'This is sample description', 'city' => 1, 'zip_code' => '10115', 'execute_at' => $datetime, 'category' => 804040],
                'status' => 201,
                '{"id":1,"title":"This is a sample title","description":"This is sample description","zip_code":10115,"category":{"id":804040,"name":"Sonstige Umzugsleistugen"}}'
            ]
        ];
    }

    /**
     * Returns response after initiating post request
     *
     * @param string $uri
     * @param array $data
     * @return Response
     */
    private function post($uri, array $data) : Response
    {
        $headers = array('CONTENT_TYPE' => 'application/json');
        $content = json_encode($data);
        $client = static::createClient();
        $client->request('POST', $uri, array(), array(), $headers, $content);

        return $client->getResponse();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}