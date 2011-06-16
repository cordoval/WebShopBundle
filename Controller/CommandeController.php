<?php
namespace CSF\CartBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use CSF\CartBundle\Model\HandleCommandeInterface;
use CSF\CartBundle\Model\HandleCommandeSession;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Doctrine\ORM\NoResultException;

use JMS\SecurityExtraBundle\Annotation\SecureParam;

use CSF\CartBundle\Entity\CommandeStatusCode;

use CSF\CartBundle\Entity\CommandeClient;

use CSF\CartBundle\Entity\CommandeItems;

use CSF\CartBundle\Entity\Products;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CSF\CartBundle\Validator\Modification;

class CommandeController extends Controller
{

	/**
	 * @Route("/", name="_panier")
	 * @Template()
	 * Enter description here ...
	 */
	public function panierAction()
	{
		$em = $this->get('doctrine')->getEntityManager();
		$user = $this->get('security.context')->getToken()->getUser();
		
		$handle = $this->get('cart.handle');
		
		$panier = $handle->checkPanierExist();				
		
		$request = $this->get('request');
		if($request->getMethod() == 'POST') {
        	if(!$handle->makeModification($request)){
        		$this->get('session')->setFlash('panier', Modification::$message);        		        			
        	}else{
        		$this->get('session')->setFlash('panier', 'Modification effectuée');        		 
        	}        	      	

            return $this->redirect($this->generateUrl('_panier'));
            
        }
        		
		// Si panier vide on ne fait pas de requête
		// Sinon on récupère son contenu
		$nbre=0;
				
		if($handle->getNombreItems() != 0){
			$nbre = $handle->getNombreItems();
			$panier = $handle->getContenuDuPanier();			
		}
		
		
		return array('panier' => $panier, 'nombre' => $nbre);
	}
		
	
	/**
	 * @Route("/Ajouter/{id}", name="ajout_panier")
	 * @Template()
	 * Ajouter un produit dans le panier
	 */
	public function ajouterAction($id)
	{		
		$handle = $this->get('cart.handle');
		$produit = $handle->ajouterProduit($id);
		
		$this->get('session')->setFlash('panier', $produit.' bien ajouté dans votre panier !');
				
		return new RedirectResponse($this->generateUrl('_panier'));
		
	}
	
	/**
	 * @Route("/Supprimer/{id}", name="suppr_prod_panier")
	 * @Template()
	 */
	public function supprimerItemAction($id)
	{
		$handle = $this->get('handle.commande');
		$check = $handle->supprimerDuPanier($id);
		if($check){
			$this->get('session')->setFlash('panier', 'Suppression effectuée de votre panier.');
		}else{
			$this->get('session')->setFlash('notice', 'Il n\'y avait rien dans votre panier');
		}
				
		return new RedirectResponse($this->generateUrl('_panier'));
	}
	
	/**
	 * @Route("/NombresItems", name="nombre_panier")
	 * @Template
	 * Enter description here ...
	 */
	public function nombreItemsPanierAction()
	{
		$session = $this->get('request')->getSession();
		$nbre = 0;
		/*if(!$session->has('panier'))
		{
			$handle = $this->get('handle.commande');
			$panier = $handle->checkPanierExist();
			$session->set('panier', $panier->getNombreItems());
			$nbre = $panier->getNombreItems();
		}else{
			$nbre = $session->get('panier');	
		}		
		*/
		return array('panierNbre' => $nbre );
	}
	
	public function preExecute()
	{
		$session = $this->get('session');
		$user = $this->get('security.context')->getToken()->getUser();
	    if($session->has('panier_session'))
	    {
	    	if($session->get('panier_session') == false && $this->get('security.context')->isGranted('ROLE_USER')){
	    			$this->get('cart.handle')->setHandleCommande($this->get('handle.commande'));	
	    		}else{
	    			$session->set('panier_session', true);//Il utilisera le panier en mode session
	    			$this->get('cart.handle')->setHandleCommande($this->get('handle.commande.session'));
	    		}
	    }else{
	    	$session->set('panier_session', true);//Il utilisera le panier en mode session
	     	$this->get('cart.handle')->setHandleCommande($this->get('handle.commande.session'));
	    	
	    }
	}
}