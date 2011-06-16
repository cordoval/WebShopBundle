<?php
namespace CSF\CartBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CommandeStatusCodeAdmin extends Admin
{
	protected $list = array(
        'id','statusDescription' => array('identifier' => true), 
		'_action' => array(
		  'actions' => array(
		    'delete' => array(),
		    'edit' => array()
		  )
		),
    );

    protected $form = array(
        'statusDescription' => array('name' => 'Status'),    	
        
    );

    protected $filter = array(
       'statusDescription',
    );

}