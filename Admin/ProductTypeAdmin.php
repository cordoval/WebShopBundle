<?php
namespace CSF\CartBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ProductTypeAdmin extends Admin
{
	protected $list = array(
        'name' => array('identifier' => true),    
		'slug',    
    );

    protected $form = array(
        'name',
        
    );

    protected $filter = array(
       'name'
    );

public function configureFormFields(FormMapper $form)
    {
        // ... 
        $form->add('image', array(), array('delete' => array(),'edit' => 'list', 'link_parameters' => array('context' => 'default')));
        // ...
    }
}