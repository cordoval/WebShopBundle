<?php
namespace CSF\CartBundle\Model;

use Symfony\Component\HttpFoundation\Session;

class CartHandleCommande
{
	protected $handleCommande;
	
	public function __construct(HandleCommandeInterface $handle, Session $session)
	{
		$this->handleCommande = $handle;		
	}
	
	public function setHandleCommande(HandleCommandeInterface $handle)
	{
		$this->handleCommande = $handle;
	}
	
	/**
	 * Retourne un panier
	 * @return CommandeClient
	 * Enter description here ...
	 */
	function checkPanierExist()
	{
		return $this->handleCommande->checkPanierExist();
	}
	
	/**
	 * 
	 * Modification de la quantité
	 * @param Request $request
	 * @return boolean
	 */
	function makeModification($request)
	{
		return $this->handleCommande->makeModification($request);
	}
	
	/**
	 * 
	 * Ajouter produit dans panier
	 * @param IDproduit $IDProd
	 * @return Products
	 */
	function ajouterProduit($IDProd)
	{
		return $this->handleCommande->ajouterProduit($IDProd);
	}
	
	/**
	 * 
	 * Supprimer un produit du panier
	 * @param integer $IDCommande
	 */
	function supprimerDuPanier($IDCommande)
	{
		return $this->handleCommande->supprimerDuPanier($IDCommande);
	}
	
	function getContenuDuPanier()
	{
		return $this->handleCommande->getContenuDuPanier();
	}
	
	function getNombreItems()
	{
		return $this->handleCommande->getNombreItems();
	}
}