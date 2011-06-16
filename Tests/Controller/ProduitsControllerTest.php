<?php
namespace CSF\CartBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitsControllerTest extends WebTestCase
{
	public function testList()
	{
		$client = $this->createClient();

        $crawler = $client->request('GET', '/Produits/liste-des-Produits');

        $this->assertTrue($crawler->filter('html:contains("produits")')->count() > 0, "test");
    
		
	}
}