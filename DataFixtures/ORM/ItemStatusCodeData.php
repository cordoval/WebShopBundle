<?php
namespace CSF\CartBundle\DataFixtures\ORM;

use CSF\CartBundle\Entity\CommandeItemStatusCode;

use Doctrine\Common\DataFixtures\FixtureInterface;

class ItemStatusCodeData implements FixtureInterface
{
 	public function load($em)
    {
    	
       $pt = new CommandeItemStatusCode();
       $pt->setDescription("En stock");             
       $em->persist($pt );

       $pt1 = new CommandeItemStatusCode();
       $pt1->setDescription("Annulé");             
       $em->persist($pt1 );
       
       $em->flush();
       $em->clear(); // Detaches all objects from Doctrine!
        
    }
}