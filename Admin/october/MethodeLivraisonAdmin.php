<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class MethodeLivraisonAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Methode Livraison')
        ->setDataClass('CSF\CartBundle\Entity\MethodeLivraison')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/MethodL')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_MethodL')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(            
        	'description','frais_expedition',
        	
        ))
    ;
	}
}