<?php
namespace CSF\CartBundle\Admin;

use WhiteOctober\AdminBundle\Field\FieldConfigurator;

use WhiteOctober\AdminBundle\Action\Action;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;

class ProductsAdmin extends DoctrineORMAdmin
{
	protected function configure()
	{
		$this
        ->setName('Produits')
        ->setDataClass('CSF\CartBundle\Entity\Products')
        // optional, if not the admin class urlized
        ->setRoutePatternPrefix('/admin/Products')
            // optional, if not the admin class urlized
        ->setRouteNamePrefix('admin_Products')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(
            'name' => array('label' => 'Intitulé'),
        'prix', 'description', 'productType',
        	
        ))
    ;
	}
	
	public function configureFieldsByAction(Action $action, FieldConfigurator $fieldConfigurator)
    {
    	 if ('doctrine.orm.list' == $action->getName()) {
    	 	$fieldConfigurator->disable(array('productType'));
    	 }
    }
}