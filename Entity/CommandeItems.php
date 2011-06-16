<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * CSF\CartBundle\Entity\CommandeItems
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CommandeItems
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $date_livraison
     * 
     * @ORM\Column(name="date_livraison", type="datetime", nullable=true)
     */
    private $dateLivraison;

    /**
     * @var integer $quantite
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Products", inversedBy="commandeItems")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="CommandeItemStatusCode", inversedBy="commandeItems")
     * @ORM\JoinColumn(name="CommandeItemStatusCode_id", referencedColumnName="id")
     */
    private $commandeItemsStatusCode;

    /**
     * @ORM\ManyToOne(targetEntity="CommandeClient", inversedBy="commandeItems", cascade={"persist"} )
     * @ORM\JoinColumn(name="Commande_Client_id", referencedColumnName="id")
     */
    private $commandeClients;
    
    
    private $calculPrix;
    
   	public function __construct()
   	{
   		$this->quantite = 1;
   	}
    
    public function getCalculPrix()
    {
    	return $prix = $this->getProduct()->getPrix() * $this->quantite;    	
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date_livraison
     *
     * @param datetime $dateLivraison
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    }

    /**
     * Get date_livraison
     *
     * @return datetime $dateLivraison
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     */
    public function addQuantite()
    {
        $this->quantite ++;
    }

    /**
     * Get quantite
     *
     * @return integer $quantite
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
    
    /**
     * Set quantite
     * Enter description here ...
     * @param unknown_type $q
     */
    public function setQuantite($q)
    {
    	$this->getCommandeClients()->decrNombreItems($this->quantite);
    	$this->quantite = $q;    	
    	$this->getCommandeClients()->setNombreItems($q);
    }

    /**
     * Set product
     *
     * @param CSF\CartBundle\Entity\Products $product
     */
    public function setProduct(\CSF\CartBundle\Entity\Products $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return CSF\CartBundle\Entity\Products $product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set commandeItemsStatusCode
     *
     * @param CSF\CartBundle\Entity\CommandeItemStatusCode $commandeItemsStatusCode
     */
    public function setCommandeItemsStatusCode(\CSF\CartBundle\Entity\CommandeItemStatusCode $commandeItemsStatusCode)
    {
        $this->commandeItemsStatusCode = $commandeItemsStatusCode;
    }

    /**
     * Get commandeItemsStatusCode
     *
     * @return CSF\CartBundle\Entity\CommandeItemStatusCode $commandeItemsStatusCode
     */
    public function getCommandeItemsStatusCode()
    {
        return $this->commandeItemsStatusCode;
    }

    /**
     * Set commandeClients
     *
     * @param CSF\CartBundle\Entity\CommandeClient $commandeClients
     */
    public function setCommandeClients(\CSF\CartBundle\Entity\CommandeClient $commandeClients)
    {
        $this->commandeClients = $commandeClients;
    }

    /**
     * Get commandeClients
     *
     * @return CSF\CartBundle\Entity\CommandeClient $commandeClients
     */
    public function getCommandeClients()
    {
        return $this->commandeClients;
    }
}