<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class ItemStatusCodeAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Status code Item')
        ->setDataClass('CSF\CartBundle\Entity\CommandeItemStatusCode')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/CISC')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_CISC')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(            
        	'description',
        	
        ))
    ;
	}
}