<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\Field\FieldConfigurator;

use WhiteOctober\AdminBundle\Action\Action;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class CommandeItemsAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Commande items')
        ->setDataClass('CSF\CartBundle\Entity\CommandeItems')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/CoItems')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_CoItems')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(            
        	'quantite','product','commandeItemsStatusCode',
        	
        ))
        ->addField('dateLivraison', array('form_type' => 'date', 
            			'input'  => 'datetime',
    					'widget' => 'choice',
            			))
    ;
	}
	
	public function configureFieldsByAction(Action $action, FieldConfigurator $fieldConfigurator)
    {
        
    }
}