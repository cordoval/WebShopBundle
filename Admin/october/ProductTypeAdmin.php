<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class ProductTypeAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Type de produits')
        ->setDataClass('CSF\CartBundle\Entity\ProductsType')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/ProductType')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_ProductType')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(
            'name' => array('label' => 'Intitulé'), 'slug',
        	
        ))
    ;
	}
}