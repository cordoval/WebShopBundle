<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class CommandeStatusCodeAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Status code des Commandes')
        ->setDataClass('CSF\CartBundle\Entity\CommandeStatusCode')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/CSC')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_CSC')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(            
        	'status_description',
        	
        ))
    ;
	}
}