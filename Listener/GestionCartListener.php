<?php
namespace CSF\CartBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;

use CSF\CartBundle\Model\HandleCommande;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use CSF\CartBundle\Controller\CommandeController;

class GestionCartListener
{
	
	public function onCoreController(FilterControllerEvent $event)
	{
	    if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $aController = $event->getController();
            if (isset($aController[0]) && $aController[0] instanceof CommandeController ) {
                $controller = $aController[0];                
                $controller->preExecute();
            }
	    } 
	    
	}
}