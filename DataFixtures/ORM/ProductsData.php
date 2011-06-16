<?php
namespace CSF\CartBundle\DataFixtures\ORM;

use CSF\CartBundle\Entity\Products;

use Doctrine\Common\DataFixtures\FixtureInterface;

class ProductsData implements FixtureInterface
{
 	public function load($em)
    {
    	$batchSize = 5;
        for($i = 1; $i <= 50; $i++) {
             $pt = new Products();
             $pt->setName("Name_".$i);
             $pt->setPrix($i);
             $pt->setDescription("Description_".$i);             
            $em->persist($pt );
            if (($i % $batchSize) == 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }
        
    }
}