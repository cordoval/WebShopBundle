<?php
namespace CSF\CartBundle\Entity;

use Doctrine\ORM\NoResultException;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
	public function getProductByID($id)
	{
		$query = $this->_em->createQuery('SELECT u, v FROM CSF\CartBundle\Entity\Products u LEFT JOIN u.productType v where u.productType = v.id and u.id= ?1');
		$query->setParameter(1, $id);
		
		try {
			$produit = $query->getSingleResult();
		} catch (NoResultException $e) {
			$produit = null;
		}
		
		return $produit;
	}
}