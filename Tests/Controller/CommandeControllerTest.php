<?php
namespace CSF\CartBundle\Tests;

use CSF\CartBundle\Entity\Products;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeControllerTest extends WebTestCase
{
	public function testPanier()
	{
		$client = $this->createClient();
		$crawler = $client->request('GET', '/');
		
		
		$this->assertEquals(200, $client->getResponse()->getStatusCode(), "La page doit etre bien chargée");
				
	}
 protected function getService($name)
    {
        if (null === $this->kernel) {
            $this->kernel = $this->createKernel();
            $this->kernel->boot();
        }

        return $this->kernel->getContainer()->get($name);
    }
    
    
	public function testProduitPresentDansPanier()
	{
		$user = 3;
		$prod = 1;
		$em = $this->getService('doctrine')->getEntityManager();
		$ci = $em->getRepository('WS\WebshopBundle\Entity\User')
								->isPresentDansPanier(3,1);
		$ciCheck = $em->find('CSF\CartBundle\Entity\CommandeItems', 1);	
		$res=false;
		
		$ci->getProduct()->getId() == $ciCheck->getProduct()->getId() ? $res = true : $res = false;					
		$this->assertTrue($res, 'doit etre true ');	
		$this->assertEquals($ci,$ciCheck);
		$this->assertEquals($ci->getQuantite(),$ciCheck->getQuantite());							
	}
	
	
	
}