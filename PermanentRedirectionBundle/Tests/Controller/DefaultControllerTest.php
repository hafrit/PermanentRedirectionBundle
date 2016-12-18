<?php
/**
 * Copyright (c) 12.2016.
 * Licence GPL/GNU
 * @Author: Hamdi Afrit <hamdi.afrit@gmail.com>
 */

namespace hafrit\PermanentRedirectionBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
