<?php

namespace Chamilo\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

<<<<<<< HEAD
    public function urlProvider()
=======
    public function urlProvider(): \Generator
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        yield ['/'];
        yield ['/login'];
        yield ['/main/auth/lostPassword.php'];
    }
}