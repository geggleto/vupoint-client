<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 9:24 AM
 */

namespace Vupoint\Client;

use Vupoint\Data\Payload;

interface EmailRequestBuilderInterface
{
    /**
     * @param \GuzzleHttp\Client $client
     */
    public function setClient($client);

    /**
     * @param array $to
     */
    public function setTo($to);

    /**
     * @param string $from
     */
    public function setFrom($from);

    /**
     * @param array $cc
     */
    public function setCc($cc);

    /**
     * @param array $bcc
     */
    public function setBcc($bcc);

    /**
     * @param string $subject
     */
    public function setSubject($subject);

    /**
     * @param string $body
     */
    public function setBody($body);

    /**
     * @return Payload
     */
    public function send();
}