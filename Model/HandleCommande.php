<?php
namespace CSF\CartBundle\Model;


use CSF\CartBundle\Entity\CommandeItems;

use Doctrine\ORM\NoResultException;

use Symfony\Component\Security\Core\SecurityContext;

use CSF\CartBundle\Entity\CommandeClient;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use CSF\CartBundle\Validator\Modification;

class HandleCommande implements HandleCommandeInterface
{
	private $em;
	private $securite;
	private $user;
	
	public function __construct(EntityManager $em, SecurityContext $securite)
	{
		$this->em = $em;	
		$this->securite = $securite;
		$this->user = $this->securite->getToken()->getUser();
	}
	
	/**
	 * Enregistrer l'objet dans le panier de l'utilisateur
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function ajouterProduit($id)
	{		
		$panier = $this->checkPanierExist();			
		
		// Récupérer le produit via le slug
		$query = $this->em->createQuery('SELECT u, v FROM CSF\CartBundle\Entity\Products u LEFT JOIN u.productType v where u.productType = v.id and u.id= ?1');
		$query->setParameter(1, $id);
		
		try {
			$produit = $query->getSingleResult();
		} catch (NoResultException $e) {
			throw new NotFoundHttpException();
		}
		
		// Vérification si le produit est déjà dans le panier
		$check = null;	
		
		$check = $this->em->getRepository('WS\WebshopBundle\Entity\User')
								->isPresentDansPanier($this->user->getId(),$id);
		
		
		if($check){			
			$commandeItemCheck->addQuantite();
			$panier->addNombreItems(); // Incrémenter le nombre d'éléments dans le panier
			$this->em->persist($panier);
			$this->em->persist($commandeItemCheck);
		}else{		
			// Création de la commande du produit
			$commandeItem = new CommandeItems();
			$commandeItem->setProduct($produit);
			$commandeItem->setCommandeClients($panier);
			$statusItem = $this->em->find('CSF\CartBundle\Entity\CommandeItemStatusCode', 1);
			$commandeItem->setCommandeItemsStatusCode($statusItem);		
			
			$panier->addNombreItems(); // Incrémenter le nombre d'éléments dans le panier
			
			// Insérer dans le panier		
			$this->em->persist($panier);
			$this->em->persist($commandeItem);
		}
		
		$this->em->flush();
		
		return $produit;
	}
	
	
	/**
	 * Création d'un nouveau panier
	 * @return CSF\CartBundle\Entity\CommandeClient
	 * Enter description here ...
	 */
	public function initNewPanier()
	{
		$panier = new CommandeClient();
		$panier->setUser($this->user);
		$statusInit = $this->em->find('CSF\CartBundle\Entity\CommandeStatusCode', 2);
		if(!$statusInit){
				throw new NotFoundHttpException();
		}		
		$panier->setStatusCommande($statusInit);
		$this->em->persist($panier);
		$this->em->flush();
		
		return $panier;
	}
	
	/**
	 * Retourne un panier
	 * Le crée si inexistant
	 * Enter description here ...
	 */
	public function checkPanierExist()
	{
		$panier;
		try {
			$panier = $this->em->getRepository('WS\WebshopBundle\Entity\User')
								->getPanierExiste($this->user->getId());
		} catch (NoResultException $e) {
		// Si aucun panier, on en crée un
			$panier = $this->initNewPanier();
		} 		
		return $panier;
	}
	
	/**
	 * Vérifie si un produit est déjà dans le panier d'un utilisateur
	 * @param $id_user
	 * @param $id_produit
	 * @return boolean		  
	 */
	protected function checkProduitExisteDansPanier($user_id,$prod_id)
	{	
		$check = null;	
		try {
			$commandeItemCheck = $this->em->getRepository('WS\WebshopBundle\Entity\User')
								->isPresentDansPanier($user_id,$prod_id);
			$check = $commandeItemCheck;
		} catch (NoResultException $e) {
			$check = false;
		}
		return $check;
	}
	
	/**
	 * Supprimer une ligne du panier (produit+quantité)
	 * @return boolean
	 */
	public function supprimerDuPanier($id)
	{
		$panier = $this->checkPanierExist();
		if($panier->getNombreItems() == 0){
			return false;
		}else{
			$this->em->getRepository('WS\WebshopBundle\Entity\User')->
					supprimerProduitDuPanier($this->user->getId(),$id);
			return true;			
		}
	}	
	
	/**
	 * Validation de la valeur passée à la quantité
	 * Enter description here ...
	 * @param unknown_type $request
	 */
	public function makeModification($request)
	{
		$q = $request->get('quantite');
        $id = $request->get('id');
        $checkValue = Modification::testValeur($q);
        if($checkValue)
        {
        	$this->em->persist($this->modifierQuantite($request));
        	$this->em->flush();
        	return true;
        }else{
        	return false;
        }	
	}
	
	/**
	 * Modifier la quantité
	 * Enter description here ...
	 * @param unknown_type $request
	 */
	public function modifierQuantite($request)
	{		
		$q = $request->get('quantite');
        $id = $request->get('id');
        $com = $this->em->getRepository('CSF\CartBundle\Entity\CommandeItems')->findOneBy(array('id' => $id));
        $com->setQuantite($q);
        
                	
        	return $com;
	}
	
	
	/**
	 * Retourne le contenu du panier de l'utilisateur
	 * Enter description here ...
	 * @param unknown_type $IdUser
	 */
	public function getContenuDuPanier()
	{
		return $this->em->getRepository('WS\WebshopBundle\Entity\User')
								->getContenuPanier($this->user->getId());
	}
	
	/**
	 * Retourne le nombre d'items dans le panier
	 * Enter description here ...
	 */
	public function getNombreItems()
	{
		return $this->checkPanierExist()->getNombreItems();
	}
	
}