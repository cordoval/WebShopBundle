<?php
namespace CSF\CartBundle\Model;

use CSF\CartBundle\Validator\Modification;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Session;
use CSF\CartBundle\Model\PanierSession\Panier;
use CSF\CartBundle\Entity\CommandeClient;
use CSF\CartBundle\Model\PanierSession\ContenuPanier;

class HandleCommandeSession implements HandleCommandeInterface
{
	private $session;
	private $em;

	public function __construct(EntityManager $em,Session $session)
	{			
		$this->em = $em;
		$this->session = $session;	
	}
	

	/**
	 * Retourne un panier
	 * @return CommandeClient
	 * Enter description here ...
	 */
	function checkPanierExist()
	{		
		return $this->creationPanier();
	}
	
	private function creationPanier(){
	   if (!$this->session->has('panier')){	  
	   		$this->session->set('panier', array());
	   }
	   	
	   return $this->session->get('panier');
	}
	
	/**
	 * Retourne le nombre d'items dans le panier
	 * Enter description here ...
	 */
	public function getNombreItems()
	{
		$panier = $this->session->get('panier');
		$qt=0;
		foreach ($panier as $item)
		{
			$qt += $item['quantite'];
		}
		return $qt;
	}
	
	/**
	 * Retourne le contenu du panier de l'utilisateur
	 * Enter description here ...
	 * @param unknown_type $IdUser
	 */
	function getContenuDuPanier()
	{
		return $this->session->get('panier');
		
	}
	
	
	/**
	 * 
	 * Modification de la quantité
	 * @param Request $request
	 * @return boolean
	 */
	function makeModification($request)
	{
		$q = $request->get('quantite');
        $id = $request->get('id');
        $checkValue = Modification::testValeur($q);
        if($checkValue)
        {
        	$panier = $this->checkPanierExist();
        	
        	foreach ($panier as $key => $item)
			{
				if($item['id'] == $id){
					$panier[$key]['quantite'] = $q;	
					$panier[$key]['calculPrix'] = $q * $panier[$key]['product']['prix'];
				}
			}
			
		
        	
        	$this->session->set('panier', $panier);
			$this->session->save();				
        	return true;
        }else{
        	return false;
        }	
	}
	
	/**
	 * 
	 * Ajouter produit dans panier
	 * @param IDproduit $IDProd
	 * @return Products
	 */
	function ajouterProduit($IDProd)
	{
		$panier = $this->checkPanierExist();
		$ligne = count($panier);
		$ligne = $ligne == 0 ? $ligne : $ligne ++; 
		
		
		$check = $this->checkProduitDansPanier($panier,$IDProd);
		if($check != false){
			// Incrémenter quantité du nombre de produits choisis
			$panier = $this->modifierQuantite($panier, $IDProd);
			$prod = $this->em->getRepository('CSF\CartBundle\Entity\Products')
						->getProductByID($IDProd);			
		}else{
			$prod = $this->em->getRepository('CSF\CartBundle\Entity\Products')
						->getProductByID($IDProd);
			$statusItem = $this->em->find('CSF\CartBundle\Entity\CommandeItemStatusCode', 1);
			$panier[] = array(
					'id' => $ligne, 
					'quantite' => 1, 
					'calculPrix' => $prod->getPrix(),
					'commandeItemsStatusCode' => array(
						'id'   => $statusItem->getId(),
						'description' => $statusItem->getDescription(),
					),								
						'product' => array(
							'id' => $IDProd,
							'name' => $prod->getName(),
							'slug' => $prod->getSlug(),
							'prix' => $prod->getPrix(),
							'description' => $prod->getDescription(),
							'productType' => array(
								'id'   => $prod->getProductType()->getId(),
								'name' => $prod->getProductType()->getName(),							
						)
					));
		}
		
		
		$this->session->set('panier', $panier);
		$this->session->save();				
		return $prod;
	}
	
	/**
	 * 
	 * Retourne le produit si trouvé, sinon false
	 * @param unknown_type $panier
	 * @param unknown_type $IDProd
	 */
	private function checkProduitDansPanier($panier,$IDProd){
		foreach ($panier as $item)
		{
			foreach ($item as $produit) {
				if($produit['id'] == $IDProd){
					return $item;
				}
			}
		}
		return false;
	}
	
	/**
	 * 
	 * Modifier la quantité d'un produit par idproduit
	 * @param unknown_type $panier
	 * @param unknown_type $IDProd
	 */
	private function modifierQuantite($panier, $IDProd)
	{
		foreach ($panier as $key => $item)
		{
			foreach ($item as $k) {
				if($k['id'] == $IDProd){
					$panier[$key]['quantite'] ++;	
					$calculprix = $panier[$key]['quantite'];
					$panier[$key]['calculPrix'] = $calculprix * $panier[$key]['product']['prix'];
				}
			}
		}
		return $panier;
	}
	
	/**
	 * 
	 * Supprimer un produit du panier
	 * @param integer $IDCommande
	 */
	function supprimerDuPanier($IDCommande)
	{
		return null;
	}
}