<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class CommandeClientAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Commandes des clients')
        ->setDataClass('CSF\CartBundle\Entity\CommandeClient')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/CommCli')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_CommCli')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(            
        	'createdAt',
        	
        ))
    ;
	}
}