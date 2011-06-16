<?php
namespace CSF\CartBundle\Controller;

use Zend\Paginator\Paginator;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
	/**
	 * 
	 * 
	 * @Route("/liste-des-Produits/{page}", name="list_prod", defaults={"page"=1})
	 * @Template()
	 * Enter description here ...
	 */
	public function listAction($page)
	{
		 $em = $this->get('doctrine')->getEntityManager();
		 
		 $query = $em->createQuery("select u, v from CSF\CartBundle\Entity\Products u left join u.productType v where u.productType = v.id");
		 $result = clone $query;
		 $result = $result->getResult();	
		 $adapter = $this->get('knplabs_paginator.adapter');		 
		 $adapter->setQuery($query);
		 $adapter->setDistinct(true);
	
		 $paginator = new Paginator($adapter);
		 $paginator->setCurrentPageNumber($page);
		 $paginator->setItemCountPerPage(10);
		 $paginator->setPageRange(6);
		 
			 
		return array('paginator' => $paginator, 'res' => $result);
	}
	
	/**
	 * @Route("/{slug}", name="show_prod")
	 * @Template()
	 * 
	 */
	public function showAction($slug)
	{
		$em = $this->get('doctrine')->getEntityManager();
		$query = $em->createQuery('SELECT u, v FROM CSF\CartBundle\Entity\Products u LEFT JOIN u.productType v where u.productType = v.id and u.slug= ?1');
		$query->setParameter(1, $slug);
		
		$result = $query->getSingleResult();
		return array('produit' => $result);
	}
}