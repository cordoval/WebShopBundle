<?php
namespace CSF\CartBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProductsAdmin extends Admin
{
	protected $list = array(
        'name' => array('identifier' => true),    
		 'prix', 'description'  , 'productType' => array('name' => 'Type' ,'type' => 'string'),
		'_action' => array(
		  'actions' => array(
		    'delete' => array(),
		    'edit' => array()
		  )
		),
    );

    protected $form = array(
        'name',
    	'productType' => array('edit' => 'list'),
    	'prix', 'description',
        
    );

    protected $filter = array(
       'name', 'prix'
    );
    
	

}