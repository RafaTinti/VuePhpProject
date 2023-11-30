<?php

use PHPUnit\Framework\TestCase;

class ReadTest extends TestCase{
    private $http;

    public function setUp(): void
    {
        $this->http = new GuzzleHttp\Client(['http_errors' => false]);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    /**
     * Tries to get the customer with id 1 checks response code and if id of the data retrived is 1
     */
    public function testRead(){
        $response = $this->http->request('GET', 'http://localhost/vuephpproject/backend/api/customer/read.php?id=1');
        // fwrite(STDERR, print_r($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());

        $body = json_decode($response->getBody()->getContents());

        // fwrite(STDERR, print_r(print_r($body)));
        
        $this->assertEquals(1, $body->data->ID);
    }

    /**
     * Tries to get the all customers check response code and if rowcount is bigger than 0
     */
    public function testReadAll(){
        $response = $this->http->request('GET', 'http://localhost/vuephpproject/backend/api/customer/readAll.php');
        // fwrite(STDERR, print_r($response->getBody()->getContents()));
        $this->assertEquals(200, $response->getStatusCode());

        $body = json_decode($response->getBody()->getContents());

        // fwrite(STDERR, print_r(print_r($body)));
        
        $this->assertGreaterThan(0, $body->rowCount);
    }
}