<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-06
 * Time: 2:28 PM
 */

namespace Vupoint\Client;


use GuzzleHttp\Client;
use Vupoint\Data\Payload;

class EmailRequestBuilder implements EmailRequestBuilderInterface
{
    /** @var Client */
    protected $client;

    protected $to = [];
    protected $from = "";
    protected $cc = [];
    protected $bcc = [];
    protected $subject = "";
    protected $body = "";
    protected $endpoint = "";

    /**
     * EmailRequestBuilder constructor.
     * @param Client $client
     * @param string $endpoint
     */
    public function __construct(Client $client, $endpoint = "")
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @param array $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @param array $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return Payload
     */
    public function send() {
        $response = $this->client->post($this->endpoint, [
            'body' => [
                'to' => $this->to,
                'cc' => $this->cc,
                'bcc' => $this->bcc,
                'from' => $this->from,
                'subject' => $this->subject,
                'body' => $this->body
            ]
        ]);

        $json = $response->json();

        $payload = new Payload();
        $payload->setPayload($json['payload']);
        $payload->setMessage($json['message']);
        $payload->setStatus($json['status']);

        return $payload;
    }
}