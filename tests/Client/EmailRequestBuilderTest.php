<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 8:42 AM
 */

namespace Vupoint\Tests\Builder;


use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;
use PHPUnit\Framework\TestCase;
use \Mockery as m;
use Vupoint\Client\EmailRequestBuilder;

class EmailRequestBuilderTest extends TestCase
{
    /**
     * @return \GuzzleHttp\Client
     */
    public function makeGuzzle() {
        $service = m::mock('\GuzzleHttp\Client');
        $service->shouldReceive('post')->times(1)->andReturn($this->makeResponse());
        return $service;
    }

    public function makeResponse() {
        $json = [
            "payload" => "b",
            "status" => "c",
            "message" => "a"
        ];

        $response = new Response(200);
        $response->setBody(new Stream(fopen("php://temp", "rw")));
        $response->getBody()->write(json_encode($json));

        return $response;
    }

    public function testRequestBuilder() {
        $builder = new EmailRequestBuilder($this->makeGuzzle(), "");
        $payload = $builder->send();

        $this->assertEquals("b", $payload->getPayload());
        $this->assertEquals("c", $payload->getStatus());
        $this->assertEquals("a", $payload->getMessage());
    }
}