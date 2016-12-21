<?php

namespace Beyerz\CheckBookIOBundle\Tests\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Beyerz\CheckBookIOBundle\Controller\DefaultController;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ogp');

        $this->assertContains('Open Graph Protocol Symfony Bundle', $client->getResponse()->getContent());
    }
}
