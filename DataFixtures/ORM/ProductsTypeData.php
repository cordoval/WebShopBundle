<?php
namespace CSF\CartBundle\DataFixtures\ORM;

use CSF\CartBundle\Entity\ProductsType;

use Doctrine\Common\DataFixtures\FixtureInterface;

class ProductsTypeData implements FixtureInterface
{
 	public function load($em)
    {
    	$batchSize = 5;
        for($i = 1; $i <= 10; $i++) {
             $pt = new ProductsType();
             $pt->setName("Type_".$i);                          
            $em->persist($pt );
            if (($i % $batchSize) == 0) {
                $em->flush();
                $em->clear(); // Detaches all objects from Doctrine!
            }
        }
        
    }
}