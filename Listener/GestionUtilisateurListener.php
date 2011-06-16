<?php
namespace CSF\CartBundle\Listener;

use CSF\CartBundle\Model\HandleCommande;

use CSF\CartBundle\Model\CartHandleCommande;

use Symfony\Component\HttpFoundation\Session;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class GestionUtilisateurListener
{		
	protected $session;
	
	public function __construct(Session $session)
	{
		$this->session = $session;		
	}
	
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->session->set('panier_session', false);        
    }
}