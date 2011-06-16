<?php
namespace CSF\CartBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CommandeItemsAdmin extends Admin
{
	protected $list = array(
        'id' => array('identifier' => true),    
		 'dateLivraison', 'quantite',
	 'product' => array('name' => 'Produit' ,'type' => 'string'),
		'calculPrix' => array('type' => 'string', 'name' => 'Prix calculé'),
		'commandeItemsStatusCode' => array('type' => 'string', 'name' => 'Status'), 
		'_action' => array(
		  'actions' => array(
		    'delete' => array(),
		    'edit' => array()
		  )
		),
    );

    protected $form = array(
        'dateLivraison',
    	'product' => array('edit' => 'list'),
    	'quantite', 'commandeItemsStatusCode' => array('edit' => 'list'),
        
    );

    protected $filter = array(
       'id',
    );

}