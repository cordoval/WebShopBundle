<?php
use CSF\CartBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Request;
use CSF\CartBundle\Entity\CommandeClient;

namespace CSF\CartBundle\Model;

interface HandleCommandeInterface
{
	/**
	 * Retourne un panier
	 * @return CommandeClient
	 * Enter description here ...
	 */
	function checkPanierExist();
	
	/**
	 * 
	 * Modification de la quantité
	 * @param Request $request
	 * @return boolean
	 */
	function makeModification($request);
	
	/**
	 * 
	 * Ajouter produit dans panier
	 * @param IDproduit $IDProd
	 * @return Products
	 */
	function ajouterProduit($IDProd);
	
	/**
	 * 
	 * Supprimer un produit du panier
	 * @param integer $IDCommande
	 */
	function supprimerDuPanier($IDCommande);
	
	/**
	 * Retourne le contenu du panier de l'utilisateur
	 * Enter description here ...
	 * @param unknown_type $IdUser
	 */
	function getContenuDuPanier();
	
	/**
	 * Retourne le nombre d'items dans le panier
	 * Enter description here ...
	 */
	function getNombreItems();
	
}