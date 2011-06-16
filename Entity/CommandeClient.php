<?php

namespace CSF\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WS\WebshopBundle\Entity\User;
/**
 * CSF\CartBundle\Entity\CommandeClient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CSF\CartBundle\Entity\CommandeClientRepository")
 */
class CommandeClient 
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
     * @var datetime $createdAt
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

	/**
     * @ORM\ManyToOne(targetEntity="CommandeStatusCode", inversedBy="commandeClients")
     * @ORM\JoinColumn(name="status_commande_id", referencedColumnName="id")
     */
    private $statusCommande;
    
    /**
     * @ORM\ManyToOne(targetEntity="MethodeLivraison", inversedBy="commandeClients")
     * @ORM\JoinColumn(name="methode_livraison_id", referencedColumnName="id")
     */
    private $methodeLivraison;
    
    /**
     * @ORM\OneToMany(targetEntity="CommandeItems", mappedBy="commandeClients", cascade={"persist"} )
     */
    private	$commandeItems;
    
    /**
     * @ORM\ManyToOne(targetEntity="WS\WebshopBundle\Entity\User", inversedBy="commandeClients",cascade={"all"} )
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * 
     * @ORM\Column(name="nombre_items", type="integer")
     * @var unknown_type
     */
    private $nombreItems = 0;
    
    public function __construct()
    {
        $this->commandeItems = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get createdAt
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set statusCommande
     *
     * @param CSF\CartBundle\Entity\CommandeStatusCode $statusCommande
     */
    public function setStatusCommande(\CSF\CartBundle\Entity\CommandeStatusCode $statusCommande)
    {
        $this->statusCommande = $statusCommande;
    }

    /**
     * Get statusCommande
     *
     * @return CSF\CartBundle\Entity\CommandeStatusCode $statusCommande
     */
    public function getStatusCommande()
    {
        return $this->statusCommande;
    }

    /**
     * Set methodeLivraison
     *
     * @param CSF\CartBundle\Entity\MethodeLivraison $methodeLivraison
     */
    public function setMethodeLivraison(\CSF\CartBundle\Entity\MethodeLivraison $methodeLivraison)
    {
        $this->methodeLivraison = $methodeLivraison;
    }

    /**
     * Get methodeLivraison
     *
     * @return CSF\CartBundle\Entity\MethodeLivraison $methodeLivraison
     */
    public function getMethodeLivraison()
    {
        return $this->methodeLivraison;
    }

    /**
     * Add commandeItems
     *
     * @param CSF\CartBundle\Entity\CommandeItems $commandeItems
     */
    public function addCommandeItems(\CSF\CartBundle\Entity\CommandeItems $commandeItems)
    {
        $this->commandeItems[] = $commandeItems;
        
    }

    /**
     * Get commandeItems
     *
     * @return Doctrine\Common\Collections\Collection $commandeItems
     */
    public function getCommandeItems()
    {
        return $this->commandeItems;
    }

    /**
     * Set user
     *
     * @param WS\WebshopBundle\Entity\User $user
     */
    public function setUser(\WS\WebshopBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return WS\WebshopBundle\Entity\User $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
	public function getNombreItems()
    {
    	return $this->nombreItems;
    }
    
    public function addNombreItems()
    {
    	$this->nombreItems ++;
    }
    
    public function setNombreItems($v)
    {
    	$this->nombreItems += $v;
    }
    
    public function decrNombreItems($val)
    {
    	$this->nombreItems -= $val;
    }
}